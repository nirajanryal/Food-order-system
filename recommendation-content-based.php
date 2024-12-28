<?php

include('connect.php');

function tokenize($text)
{
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9 ]/', '', $text);
    $words = explode(' ', $text);
    return array_count_values($words);
}

function dotProduct($vecA, $vecB)
{
    $dotProduct = 0;
    foreach ($vecA as $key => $value) {
        if (isset($vecB[$key])) {
            $dotProduct += $value * $vecB[$key];
        }
    }
    return $dotProduct;
}

function magnitude($vector)
{
    $magnitude = 0;
    foreach ($vector as $value) {
        $magnitude += $value * $value;
    }
    return sqrt($magnitude);
}

function cosineSimilarity($description1, $description2)
{
    $vecA = tokenize($description1);
    $vecB = tokenize($description2);

    $dotProduct = dotProduct($vecA, $vecB);
    $magnitudeA = magnitude($vecA);
    $magnitudeB = magnitude($vecB);

    if ($magnitudeA * $magnitudeB == 0) {
        return 0;
    } else {
        return $dotProduct / ($magnitudeA * $magnitudeB);
    }
}

function recommendFoodForUser($email, $conn, $priceWeight = 0.5, $maxRecommendations = 5, $scoreThreshold = 0.1)
{
    // Step 1: Retrieve user's most ordered food titles
    $query = "
        SELECT food 
        FROM `order` 
        WHERE email = ? 
        GROUP BY food 
        ORDER BY COUNT(*) DESC 
        LIMIT 3";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $userFavoriteTitles = [];
    while ($row = $result->fetch_assoc()) {
        $userFavoriteTitles[] = $row['food'];
    }

    if (empty($userFavoriteTitles)) {
        return [];
    }

    // Step 2: Retrieve descriptions for the user's favorite foods
    $userFavoriteDescriptions = [];
    foreach ($userFavoriteTitles as $title) {
        $query = "SELECT description FROM food WHERE title = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $stmt->bind_result($description);
        if ($stmt->fetch()) {
            $userFavoriteDescriptions[] = $description;
        }
        $stmt->close();
    }

    // Step 3: Fetch all food items
    $query = "SELECT * FROM food";
    $result = $conn->query($query);
    $allFoodItems = $result->fetch_all(MYSQLI_ASSOC);

    $recommendations = [];

    // Step 4: Compare each food item to user's favorite food descriptions
    foreach ($allFoodItems as $foodItem) {
        $maxSimilarity = 0;

        foreach ($userFavoriteDescriptions as $favoriteDescription) {
            $similarity = cosineSimilarity($favoriteDescription, $foodItem['description']);
            if ($similarity > $maxSimilarity) {
                $maxSimilarity = $similarity;
            }
        }

        // Step 5: Check if the user already ordered this food
        $alreadyOrdered = false;
        $query = "
            SELECT COUNT(*) as count 
            FROM `order` 
            WHERE email = ? AND food = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $foodItem['title']);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $alreadyOrdered = true;
        }

        // Step 6: If not already ordered, calculate score and add to recommendations
        if (!$alreadyOrdered && $maxSimilarity >= $scoreThreshold) {
            $priceDifference = 0;
            $score = $maxSimilarity - $priceWeight * $priceDifference;

            $recommendations[] = [
                'fid' => $foodItem['fid'],
                'title' => $foodItem['title'],
                'description' => $foodItem['description'],
                'image' => $foodItem['image_name'],
                'price' => $foodItem['price'],
                'score' => $score
            ];
        }
    }

    // Step 7: Sort recommendations by score
    usort($recommendations, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    // Step 8: Return only the top N recommendations
    return array_slice($recommendations, 0, $maxRecommendations);
}


?>
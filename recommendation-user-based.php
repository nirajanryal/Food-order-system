<?php
include('connect.php');
// session_start();

// Function to calculate similarity between two users
function calculateSimilarity($user1, $user2, $con) {
    $sql = "SELECT r1.fid, r1.rating AS rating1, r2.rating AS rating2 
            FROM user_ratings r1 
            JOIN user_ratings r2 ON r1.fid = r2.fid 
            WHERE r1.uid = $user1 AND r2.uid = $user2";
    
    $result = $con->query($sql);
    $numRows = $result->num_rows;

    if ($numRows == 0) {
        return 0;
    }

    $sum1 = $sum2 = $sum1Sq = $sum2Sq = $pSum = 0;
    while ($row = $result->fetch_assoc()) {
        $rating1 = $row['rating1'];
        $rating2 = $row['rating2'];

        $sum1 += $rating1;
        $sum2 += $rating2;
        $sum1Sq += pow($rating1, 2);
        $sum2Sq += pow($rating2, 2);
        $pSum += $rating1 * $rating2;
    }

    $num = $pSum - ($sum1 * $sum2 / $numRows);
    $den = sqrt(($sum1Sq - pow($sum1, 2) / $numRows) * ($sum2Sq - pow($sum2, 2) / $numRows));

    if ($den == 0) {
        return 0;
    }

    return $num / $den;
}

// Function to get recommendations for a user
function getRecommendations($userId, $con) {
    $similarityScores = [];
    $sql = "SELECT DISTINCT uid FROM user_ratings WHERE uid != $userId";
    $result = $con->query($sql);

    while ($row = $result->fetch_assoc()) {
        $otherUserId = $row['uid'];
        $similarityScores[$otherUserId] = calculateSimilarity($userId, $otherUserId, $con);
    }

    // Sort users by similarity score
    arsort($similarityScores);

    $recommendations = [];
    $totalSimilarity = [];

    // Accumulate weighted ratings for recommendations
    foreach ($similarityScores as $otherUserId => $similarity) {
        if ($similarity <= 0) {
            continue;
        }

        $sql = "SELECT fid, rating FROM user_ratings WHERE uid = $otherUserId AND fid NOT IN 
                (SELECT fid FROM user_ratings WHERE uid = $userId)";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $foodId = $row['fid'];
            $weightedRating = $row['rating'] * $similarity;

            if (!isset($recommendations[$foodId])) {
                $recommendations[$foodId] = 0;
                $totalSimilarity[$foodId] = 0;
            }
            $recommendations[$foodId] += $weightedRating;
            $totalSimilarity[$foodId] += $similarity;
        }
    }

    // Normalize the recommendations by dividing by total similarity
    foreach ($recommendations as $foodId => $weightedRatingSum) {
        if ($totalSimilarity[$foodId] > 0) {
            $recommendations[$foodId] /= $totalSimilarity[$foodId];
        }
    }

    // Sort recommendations by score
    arsort($recommendations);

    // Insert recommendations into the recommendations table
    $con->query("DELETE FROM recommendations WHERE uid = $userId");

    foreach ($recommendations as $foodId => $score) {
        $stmt = $con->prepare("INSERT INTO recommendations (uid, fid, score) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $userId, $foodId, $score);
        $stmt->execute();
    }
}

// Example usage for all users
$sql = "SELECT DISTINCT uid FROM user_ratings";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $userId = $row['uid'];
    getRecommendations($userId, $con);
}

// $con->close();
?>

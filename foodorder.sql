-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 03:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Biryani', 'Category_6279207fb48fd.jpg', 'Yes', 'Yes'),
(2, 'Burger', 'Category_6279200ce1276.jpg', 'Yes', 'Yes'),
(3, 'Momo', 'Category_62792058bbb2e.png', 'Yes', 'Yes'),
(4, 'Pizza', 'Category_6279208fd3119.jpg', 'Yes', 'Yes'),
(5, 'Fried Rice', 'Category_627920a249bcc.jpg', 'Yes', 'Yes'),
(6, 'Chowmein', 'Category_627920b4bce45.jpg', 'Yes', 'Yes'),
(7, 'Chilli', 'Category_627920c5cb839.jpg', 'Yes', 'Yes'),
(8, 'Wings', 'Category_6279210480479.jpg', 'Yes', 'No'),
(9, 'Curry', 'Category_6279214a44337.jpg', 'Yes', 'Yes'),
(10, 'Others', 'Category_6279215df009a.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `fid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Chicken Biryani', 'Chicken, rice, curd, coriande, garlic, ginger, masala, lemon, cardamom, cinnamon, onion, cardamom', 300, 'Food_6264055fcd472.jpg', 1, 'No', 'Yes'),
(2, 'Veg Biryani', 'Oil, cinnamon, bay leaves, cardamom, onion, ginger, carrot, peas, yogurt, coriander, cooked rice', 250, 'Food_6264059656972.jpg', 1, 'Yes', 'Yes'),
(3, 'Aloo Tikki Burger', 'Poha, potatoes, pepper jack, bread crumbs, green peas', 200, 'Food_626405cdb605a.jpg', 2, 'Yes', 'Yes'),
(4, 'Fish Burger', 'eggs, flour, breadcrumbs, fish fillets, round buns, lettuce, vinegar, pepper, mayonnaise, onion', 250, 'Food_626405f323dac.jpg', 2, 'No', 'Yes'),
(5, 'Grilled Chicken Burger', 'Chicken breast, avocado, lettuce, olive oil, tomatoes', 250, 'Food_6264061d2ae3d.jpg', 2, 'No', 'Yes'),
(6, 'Veg Burger', 'olive oil, onions, spinach, breadcrumbs, cheese, flour, tomatoes, ketchup, lettuce', 180, 'Food_6264064d93f4b.webp', 2, 'No', 'Yes'),
(7, 'Veg Momo', 'Soy sauce, carrot, cabbage, capsicum, red onion, garlic, ginger', 120, 'Food_6264067ce36f7.jpg', 3, 'No', 'Yes'),
(8, 'Fried Chicken Momo', 'Chicken mince, deep fry, vinegar, black pepper, soy sauce, garlic, onion', 180, 'Food_626406a913a8d.jpg', 3, 'No', 'Yes'),
(9, 'Jhol Momo', 'Cilantro, garlic, ginger, black pepper, cinnamon, cumin, onion', 150, 'Food_626406d292870.png', 3, 'No', 'Yes'),
(10, 'Steamed Chicken Momo', 'Soy sauce, boiled chicken, green peas, onion, garlic, ginger, red chilli, black peppercorn', 160, 'Food_62640707d317b.jpg', 3, 'Yes', 'Yes'),
(11, 'Veggie Pizza', 'Seasoned tomato sauce, pizza crust, green bell paper, onion, olive oil, black olive, mushroom', 250, 'Food_626407363369d.jpg', 4, 'Yes', 'Yes'),
(12, 'Supreme Pizza', 'Pizza dough, marinara, bacon, pepperoni, red bell pepper, green bell pepper, red onion, black olive', 320, 'Food_62640750c3c01.jpg', 4, 'No', 'Yes'),
(13, 'Cheese Pizza', 'mozzarella cheese, dried oregano, dried yeast, honey, olive oil , black olive, bread flour, tomato juice', 280, 'Food_6264077816ff6.jpg', 4, 'No', 'Yes'),
(14, 'BBQ Chicken Pizza', 'chicken fajita strips, red onions, cilantro, garlic, tomatoes, black pepper, basil, barbeque sauce', 330, 'Food_626407d42ecfb.jpg', 4, 'No', 'Yes'),
(15, 'Veg Fried Rice', 'Mustard oil, chilli powder, turmeric, cumin seed, onion, peas, bell pepper, cooked rice', 180, 'Food_626407f6b6cd4.jpg', 5, 'No', 'Yes'),
(16, 'Sausage Fried Rice', 'Sunflower oil, garlic, onion, pepperami, black pepper, soy sauce, sausage, cooked rice', 220, 'Food_6264083510b49.jpg', 5, 'No', 'Yes'),
(17, 'Egg Fried Rice', 'Mustard oil, chilli powder, turmeric, cumin seed, egg, cooked rice', 200, 'Food_6264087fb9a27.webp', 5, 'No', 'Yes'),
(18, 'Chicken Fried Rice', 'Soy sauce, coriander, chicken masala, onion, bell pepper, garlic, peas, carrot, chicken pieces', 240, 'Food_626408ab58fb7.jpg', 5, 'Yes', 'Yes'),
(19, 'Butter Chicken', 'Diced chicken, yogurt, garlic, masala, ginger, cumin, turmeric, olive oil, butter, tomato, cilantro', 350, 'Food_626408d7b2ddb.jpg', 9, 'Yes', 'Yes'),
(20, 'Egg Tikka Masala', 'eggs, ginger, garlic, yogurt, onions, cumin, garam masala, green peas, coconut milk', 300, 'Food_6264091201d29.jpg', 9, 'No', 'Yes'),
(21, 'Paneer Butter Masala', 'Paneer, peas, onion, tomato, garlic, coriander, butter, masala, turmeric, yogurt, cardamom', 350, 'Food_6264096372611.jpg', 9, 'No', 'Yes'),
(22, 'Veg Chowmein', 'Soy sauce, cabbage, broccoli, carrot, peas, vinegar, ketchup, cilantro, onion, hot sauce', 140, 'Food_6264098c84797.jpg', 6, 'Yes', 'Yes'),
(23, 'Egg Chowmein', 'Soy sauce, capsicum, onion, turmeric, garlic, egg, coriander, beans, cabbage, chilli powder', 160, 'Food_626409ae48d31.jpg', 6, 'No', 'Yes'),
(24, 'Chicken Chowmein', 'Soy sauce, capsicum, onion, turmeric, garlic, chicken, coriander, beans, cabbage, chilli powder', 180, 'Food_626409cc5d211.jpg', 6, 'No', 'Yes'),
(25, 'Cauliflower Wings', 'cauliflower, plain flour, cornflour, paprika, garlic, pepper, vegetable oil, honey, paprika', 200, 'Food_62640a092bb0b.webp', 8, 'Yes', 'Yes'),
(26, 'Chicken Wings', 'Chicken wings, brown sugar, hot sauce, baking powder, garlic', 300, 'Food_62640a2f9d639.jpg', 8, 'Yes', 'Yes'),
(27, 'Chicken Chilli', 'Soy sauce, cliantro, olive oil, bell pepper, turmeric powder, vinegar, ketchup, tomato, onion\r\n', 350, 'Food_62640a7f02ab7.jpg', 7, 'Yes', 'Yes'),
(28, 'BBQ Sausage Chilli', 'Soy sauce, garlic, ginger, onion, bell pepper, tomato ketchup, coriander, lime juice, timur', 330, 'Food_62640aefcf89f.webp', 7, 'Yes', 'Yes'),
(29, 'Paneer Chilli', 'Turmeric powder, hot chilli sauce, peas, onion, bell pepper, cumin seed, tomato sauce, curry powder', 330, 'Food_62640b0b9815a.jpg', 7, 'Yes', 'Yes'),
(30, 'Egg Kathi Roll', 'egg, cilantro, mint, cumin, garlic, yogurt, flour, onions, capsicum, mushroom, tomato, green chili', 210, 'Food_62640b2d99330.webp', 10, 'Yes', 'No'),
(31, 'Onion Pakodas', 'onion, besan flour, green chili, coriander seeds, turmeric, vegetable oil, cabbage', 150, 'Food_62640b4b224c6.jpg', 10, 'Yes', 'Yes'),
(32, 'Peanut Sadheko', 'Mustard oil, garlic, ginger, peanut, edamame, lime juice, tomato, jalapeno, masala, cilantro', 160, 'Food_62640b6dab324.jpg', 10, 'Yes', 'Yes'),
(33, 'Samosa', 'flour, potatoes, boiled peas, ginger, red chilli, coriander, cumin, garam masala, peanut', 40, 'Food_62640b9916b5f.jpg', 10, 'Yes', 'Yes'),
(34, 'Aloo Sadheko', 'Mustard oil, potato, lemon juice, cumin, turmeric, pepper, ginger, coriander, tomato, onion', 140, 'Food_62640bb54d124.jpg', 10, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int(10) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `order-date` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'cart',
  `c-name` varchar(100) NOT NULL,
  `c-contact` varchar(20) NOT NULL,
  `c-address` varchar(150) NOT NULL,
  `email` varchar(120) NOT NULL,
  `payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `food`, `price`, `quantity`, `total`, `instruction`, `order-date`, `status`, `c-name`, `c-contact`, `c-address`, `email`, `payment`) VALUES
(4, 'pizza', 10, 1, 10, 'extra toppings withcheese', '2022-04-16 09:28:30pm	', 'Delivered', 'kjkjkh', 'kjhkh', 'jgh-->jhkh', 'hello@gmail.com', NULL),
(5, 'samosa', 120, 1, 120, 'red chutney', '0000-00-00 00:00:00', 'Delivered', '', '', '', 'john@gmail.com', NULL),
(7, 'samosa', 120, 1, 120, 'add green chutne a little more.', '2022-04-16  1:00PM - 1:30PM', 'Delivered', 'kjkjkh', 'kjhkh', 'jgh-->jhkh', 'hello@gmail.com', NULL),
(12, 'samosa', 120, 1, 120, 'noice noice noice\n', '2022-04-16  1:00PM - 1:30PM', 'Delivered', 'kjkjkh', 'kjhkh', 'jgh-->jhkh', 'hello@gmail.com', NULL),
(13, 'samosa', 120, 1, 120, 'bbbb', '2022-04-16  1:00PM - 1:30PM', 'Delivered', 'kjkjkh', 'kjhkh', 'jgh-->jhkh', 'hello@gmail.com', NULL),
(14, 'pizza', 10, 1, 10, '', '2022-04-16 09:02:13pm', 'Delivered', 'ram ', '65145464', 'jamal -->near ghantaghar', 'hello@gmail.com', NULL),
(15, 'samosa', 120, 3, 360, '', '2022-04-16 09:02:13pm', 'Cancelled', 'ram ', '65145464', 'jamal -->near ghantaghar', 'hello@gmail.com', NULL),
(16, 'samosa', 120, 2, 240, '', '2022-04-16 09:02:13pm', 'Cancelled', 'ram ', '65145464', 'jamal -->near ghantaghar', 'hello@gmail.com', NULL),
(17, 'samosa', 120, 5, 600, '', '2022-04-16 09:28:30pm', 'Cancelled', 'ghjgjg', 'jggjgh', 'jfldjasf-->jsfljdsfljfl', 'hello@gmail.com', NULL),
(19, 'samosa', 120, 5, 600, '', '2022-04-18 12:32:07pm', 'Delivered', 'jkjfgjklfjsd', 'jdlfjlgjfldsjgk', 'kdlhfdh-->ljfjlfkjsdf', 'hello@gmail.com', NULL),
(20, 'samosa', 120, 5, 600, '', '2022-04-22 08:41:16pm', 'On Delivery', 'hdkfhk', 'jkhdkhfhds', 'jdfljdl-->jdsflj', 'hello@gmail.com', NULL),
(22, 'Egg Chowmein', 160, 1, 160, '', '2022-04-24 11:14:49am', 'Cancelled', 'ghjgjhgjg', 'hjkkghkgjh', 'iaisdfoij-->fjddhflhk', 'hello@gmail.com', NULL),
(23, 'Peanut Sadheko', 160, 1, 160, 'do it now', '2022-04-24 11:14:49am', 'Delivered', 'ghjgjhgjg', 'hjkkghkgjh', 'iaisdfoij-->fjddhflhk', 'hello@gmail.com', NULL),
(24, 'Fish Burger', 250, 4, 1000, '', '2022-04-24 11:14:49am', 'ordered', 'ghjgjhgjg', 'hjkkghkgjh', 'iaisdfoij-->fjddhflhk', 'hello@gmail.com', NULL),
(25, 'Chicken Wings', 300, 1, 300, '', '2022-04-24 11:14:49am', 'ordered', 'ghjgjhgjg', 'hjkkghkgjh', 'iaisdfoij-->fjddhflhk', 'hello@gmail.com', NULL),
(27, 'Jhol Momo', 150, 4, 600, '', '2022-04-26 01:08:35pm', 'Delivered', 'fsndgnsdfgl', 'djjdflgjlkfj', 'gkljkjj-->dfhjdfhgkjh', 'hello@gmail.com', NULL),
(28, 'Chicken Biryani', 300, 2, 600, '', '2022-04-30 10:49:11am', 'Delivered', 'hgkhkhg', 'fhdkhfdhfd', 'kdhkhk-->hdfkhk', 'john@gmail.com', NULL),
(29, 'Aloo Sadheko', 140, 4, 560, '', '2022-04-30 10:57:48am', 'Delivered', 'kfjgljl', 'dfhkjdhfkhkd', 'hshadfkjdhas-->hsdfhkahk', 'john@gmail.com', NULL),
(30, 'Aloo Sadheko', 140, 5, 700, '', '2022-04-30 10:59:29am', 'Delivered', 'dhjhfkjdh', 'dfhkjdhfk', 'hdhskdhsj-->dsfhkjdhf', 'hello@gmail.com', NULL),
(31, 'Fried Chicken Momo', 180, 2, 360, '', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(32, 'Aloo Tikki Burger', 200, 2, 400, 'hi hello', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(33, 'Aloo Tikki Burger', 200, 1, 200, '', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(34, 'BBQ Chicken Pizza', 330, 1, 330, '', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(35, 'BBQ Sausage Chilli', 330, 1, 330, '', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(36, 'Butter Chicken', 350, 1, 350, '', '2022-05-01 10:56:07am', 'ordered', 'hghjggjhhgg', 'hgjgjgjg', 'hgjhgjgjh-->hjgjgjhg', 'hello@gmail.com', NULL),
(37, 'Aloo Sadheko', 140, 4, 560, '', '2022-05-01  4:30PM - 5:00PM', 'ordered', 'hdsfhhdkj', 'shhdkfhkhd', 'dkfhkdjh-->hdfkdkh', 'hello@gmail.com', NULL),
(38, 'Fish Burger', 250, 3, 750, '', '2022-05-09 10:51:10am', 'ordered', 'jfjklgjlkjl', 'lfjjflgjlkf', 'jorrutoi-->hgfhghjk', 'hello@gmail.com', NULL),
(39, 'Aloo Tikki Burger', 200, 1, 200, '', '2022-05-09 10:55:29am', 'ordered', 'hgkfhgkh', 'hkhfkhkdf', 'dhkdhfkj-->kdhfhkhfkj', 'hello@gmail.com', NULL),
(40, 'BBQ Sausage Chilli', 330, 1, 330, '', '2022-05-09 10:55:29am', 'ordered', 'hgkfhgkh', 'hkhfkhkdf', 'dhkdhfkj-->kdhfhkhfkj', 'hello@gmail.com', NULL),
(41, 'Butter Chicken', 350, 1, 350, '', '2022-05-09 10:55:29am', 'ordered', 'hgkfhgkh', 'hkhfkhkdf', 'dhkdhfkj-->kdhfhkhfkj', 'hello@gmail.com', NULL),
(42, 'BBQ Chicken Pizza', 330, 2, 660, '', '2022-05-09  5:00PM - 5:30PM', 'On Delivery', 'khfkdh', 'jdkfhdkfhkj', 'jhfkdjdhkfhk-->kjdhfkhdfh', 'hello@gmail.com', NULL),
(43, 'Egg Chowmein', 160, 2, 320, '', '2022-05-09  1:00PM - 1:30PM', 'Delivered', 'kdfhkhjhk', 'jkfdkhkfjhdk', 'jdjgfhj-->hgdfgjfgh', 'hello@gmail.com', NULL),
(44, 'Egg Fried Rice', 200, 2, 400, '', '2022-05-09  1:00PM - 1:30PM', 'ordered', 'kdfhkhjhk', 'jkfdkhkfjhdk', 'jdjgfhj-->hgdfgjfgh', 'hello@gmail.com', NULL),
(45, 'Veg Biryani', 250, 2, 500, '', '2022-05-11 07:55:01pm', 'ordered', 'hdfkjhk', 'jhdhkjdhfj', 'ksdfkjdshfk-->dhskfkhkj', 'hello@gmail.com', NULL),
(46, 'Aloo Tikki Burger', 200, 2, 400, '', '2022-05-11 07:55:01pm', 'ordered', 'hdfkjhk', 'jhdhkjdhfj', 'ksdfkjdshfk-->dhskfkhkj', 'hello@gmail.com', NULL),
(58, 'Steamed Chicken Momo', 160, 1, 160, '', '2022-05-11 07:55:01pm', 'ordered', 'hdfkjhk', 'jhdhkjdhfj', 'ksdfkjdshfk-->dhskfkhkj', 'hello@gmail.com', NULL),
(61, 'Aloo Sadheko', 140, 1, 140, '', '2022-05-12 12:52:08pm', 'Cancelled', 'fjhdfkh', 'jhdhhfkdhkfj', 'hdfkjhh-->hdfdhkfhk', 'hello@gmail.com', NULL),
(62, 'Aloo Tikki Burger', 200, 1, 200, '', '2022-05-12 12:52:08pm', 'ordered', 'fjhdfkh', 'jhdhhfkdhkfj', 'hdfkjhh-->hdfdhkfhk', 'hello@gmail.com', NULL),
(63, 'BBQ Chicken Pizza', 330, 1, 330, '', '2022-05-12 12:52:08pm', 'ordered', 'fjhdfkh', 'jhdhhfkdhkfj', 'hdfkjhh-->hdfdhkfhk', 'hello@gmail.com', NULL),
(64, 'Egg Chowmein', 160, 4, 640, '', '2022-05-12 01:07:44pm', 'On Delivery', 'jhgjhgjg', 'hfhfgfhf', 'hdfdkfj-->hkdhkhkf', 'hello@gmail.com', NULL),
(65, 'Aloo Tikki Burger', 200, 1, 200, '', '2022-05-12  4:00PM - 4:30PM', 'On Delivery', 'dhhfk', 'hkdhkdfh', 'khdkhfk-->khdfhkdjh', 'hello@gmail.com', NULL),
(66, 'BBQ Sausage Chilli', 330, 1, 330, '', '2022-05-12  4:00PM - 4:30PM', 'On Delivery', 'dhhfk', 'hkdhkdfh', 'khdkhfk-->khdfhkdjh', 'hello@gmail.com', NULL),
(67, 'Cauliflower Wings', 200, 1, 200, '', '2022-05-12  4:00PM - 4:30PM', 'ordered', 'dhhfk', 'hkdhkdfh', 'khdkhfk-->khdfhkdjh', 'hello@gmail.com', NULL),
(68, 'Aloo Sadheko', 140, 4, 560, '', '2022-05-15 09:23:26am', 'Delivered', 'jkdfhdk', 'khfdhdfkj', 'jhfdkh-->khdkfhk', 'hello@gmail.com', NULL),
(70, 'Aloo Tikki Burger', 200, 3, 600, '', '2022-05-15 10:42:14am', 'Delivered', 'jfglkjlk', 'kjlfjk', 'jdjslkjl-->kdjflj', 'hello@gmail.com', NULL),
(71, 'Cauliflower Wings', 200, 3, 600, '', '2022-05-15  4:00PM - 4:30PM', 'Delivered', 'kfjkdl', 'dfjkldjflk', 'dkfkjl-->jdjfldk', 'hello@gmail.com', NULL),
(72, 'Chicken Biryani', 300, 2, 600, '', '2022-05-17  3:30PM - 4:00PM', 'Delivered', 'lkdsj', '9845658456', 'jdfjglkgj-->jkljklfjldjl-', 'hello@gmail.com', NULL),
(73, 'Aloo Tikki Burger', 200, 3, 600, '', '2022-05-24  2:30PM - 3:00PM', 'ordered', 'bimal', '9812121212', 'bimal-->bimal', 'hello@gmail.com', NULL),
(75, 'Aloo Sadheko', 140, 2, 280, 'noice bimal ji', '2022-05-24  2:30PM - 3:00PM', 'ordered', 'bimal', '9812121212', 'bimal-->bimal', 'hello@gmail.com', NULL),
(76, 'Aloo Sadheko', 140, 5, 700, '', '2022-05-24  3:30PM - 4:00PM', 'Cancelled', 'bimal', '9845454545', 'bimal-->bimal', 'hello@gmail.com', NULL),
(77, 'Aloo Tikki Burger', 200, 1, 200, '', '2022-05-26 01:28:28pm', 'ordered', 'Ramesh', '9814512451', 'samkhusi-->200m north to the samakhusi petrol pump near horizon cafe', 'hello@gmail.com', NULL),
(78, 'BBQ Chicken Pizza', 330, 1, 330, '', '2022-05-26 01:28:28pm', 'ordered', 'Ramesh', '9814512451', 'samkhusi-->200m north to the samakhusi petrol pump near horizon cafe', 'hello@gmail.com', NULL),
(79, 'BBQ Sausage Chilli', 330, 1, 330, '', '2022-05-26 01:28:28pm', 'ordered', 'Ramesh', '9814512451', 'samkhusi-->200m north to the samakhusi petrol pump near horizon cafe', 'hello@gmail.com', NULL),
(80, 'Chicken Chowmein', 180, 5, 900, 'please add extra soy sauce', '2024-07-22 03:33:54pm', 'ordered', 'helloo hello', '9894564545', 'sdfd-sdfsd', 'hello@gmail.com', 'cod'),
(81, 'Chicken Fried Rice', 240, 2, 480, '', '2022-08-19  10:30AM - 11:00AM', 'Delivered', 'jdjkdjf', '9875984598', 'kdfljld-->dfjklfdj', 'john@gmail.com', NULL),
(83, 'Egg Tikka Masala', 300, 1, 300, '', '2022-08-19  10:30AM - 11:00AM', 'Delivered', 'jdjkdjf', '9875984598', 'kdfljld-->dfjklfdj', 'john@gmail.com', NULL),
(84, 'Cauliflower Wings', 200, 2, 400, '', '2022-08-19  10:30AM - 11:00AM', 'Delivered', 'jdjkdjf', '9875984598', 'kdfljld-->dfjklfdj', 'john@gmail.com', NULL),
(85, 'BBQ Chicken Pizza', 330, 5, 1650, '', '2022-08-19 10:05:39am', 'Delivered', 'khfjkdhkdjfh', '9898989898', 'khdkfhjf-->kdhfkjdhf', 'john@gmail.com', NULL),
(86, 'Aloo Sadheko', 140, 1, 140, '', '2024-07-22 03:33:54pm', 'On Delivery', 'helloo hello', '9894564545', 'sdfd-sdfsd', 'hello@gmail.com', 'cod'),
(87, 'Aloo Sadheko', 140, 4, 560, '', '2024-08-17  10:30AM - 11:00AM', 'Delivered', 'aarav aarav', '9898989766', 'Eos aute repudianda-Nisi modi proident ', 'aarav@gmail.com', 'cod'),
(89, 'Aloo Tikki Burger', 200, 3, 600, '', '2024-08-19  3:00PM - 3:30PM', 'ordered', 'anjana anjana', '9898989764', 'Aspernatur distincti-Ipsum in quaerat atq', 'anjana@gmail.com', 'cod'),
(90, 'Aloo Sadheko', 140, 4, 560, '', '2024-08-17  12:00PM - 12:30PM', 'Delivered', 'anjana anjana', '9898989764', 'Non qui excepturi et-Dolore porro est ali', 'anjana@gmail.com', 'cod'),
(91, 'Chicken Chowmein', 180, 3, 540, '', '2024-08-17  10:30AM - 11:00AM', 'ordered', 'ankit ankit', '9898989895', 'A molestiae consequa-Dolor eu alias exerc', 'ankit@gmail.com', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `rec_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `score` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`rec_id`, `uid`, `fid`, `score`) VALUES
(4249, 8, 7, 4),
(4250, 8, 14, 4),
(4251, 8, 34, 4),
(4252, 8, 28, 3),
(4253, 10, 16, 5),
(4254, 10, 4, 5),
(4255, 10, 9, 4),
(4256, 10, 2, 4),
(4257, 10, 29, 3),
(4258, 13, 11, 5),
(4259, 13, 18, 5),
(4260, 13, 4, 4.33333),
(4261, 13, 6, 4),
(4265, 15, 3, 5),
(4266, 15, 12, 5),
(4267, 15, 21, 4),
(4268, 15, 1, 4),
(4269, 15, 7, 4),
(4270, 15, 34, 4),
(4271, 15, 28, 3),
(4272, 14, 11, 5),
(4273, 14, 6, 4),
(4274, 14, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `food` varchar(50) NOT NULL,
  `review` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rid`, `userid`, `food`, `review`, `date`) VALUES
(1, 1, 'jhol momo', 'nice momo', '2022-04-23'),
(2, 1, 'Jhol Momo ', 'amazing momo super quality', '2022-04-30'),
(3, 1, 'Jhol Momo ', 'hdshfhdskfh', '2022-04-30'),
(4, 1, 'Jhol Momo ', 'ggjgjg', '2022-04-30'),
(5, 1, 'Jhol Momo ', 'bbj', '2022-04-30'),
(7, 2, 'Chicken Biryani ', 'biryani is not up to the mark \nit could have been better', '2022-04-30'),
(8, 2, 'Aloo Sadheko ', 'hhjgjgj', '2022-04-30'),
(9, 1, 'Aloo Sadheko ', 'nice', '2022-04-30'),
(10, 1, 'Samosa ', 'awesome\n', '2022-04-30'),
(11, 1, 'Samosa ', 'awesome \n', '2022-04-30'),
(12, 1, 'Samosa ', 'jghjg\n', '2022-04-30'),
(13, 1, 'Samosa ', 'jhjhkhk     \n', '2022-04-30'),
(14, 1, 'Aloo Sadheko ', 'jgjgjhj\n', '2022-04-30'),
(15, 1, 'Aloo Sadheko ', 'hhhjgjjg\n\n\n\n', '2022-04-30'),
(16, 1, 'Aloo Sadheko ', 'vjjhhhhhhhgh\n\n', '2022-04-30'),
(17, 1, 'Aloo Sadheko ', 'jhgjhg', '2022-04-30'),
(18, 1, 'Aloo Sadheko ', 'hgjgj\n\n', '2022-04-30'),
(19, 1, 'Aloo Sadheko ', 'jhghgj\n\n', '2022-04-30'),
(20, 1, 'Aloo Sadheko ', 'nice\n\n', '2022-04-30'),
(21, 1, 'Aloo Sadheko ', 'sdjkfhdk\n\n', '2022-04-30'),
(22, 1, 'Aloo Sadheko ', 'hgjgjhg', '2022-04-30'),
(23, 1, 'Aloo Sadheko ', 'jhgggjh\n', '2022-04-30'),
(24, 1, 'Aloo Sadheko ', 'ghjg', '2022-04-30'),
(25, 1, 'Aloo Sadheko ', 'jkhhjk\n\n', '2022-04-30'),
(26, 1, 'Aloo Sadheko ', 'bhggjjgjhh\n\n\n\n\n', '2022-04-30'),
(27, 1, 'Aloo Sadheko ', 'bhjh\n\n\n\n\n\n\n\n\n\n', '2022-04-30'),
(28, 1, 'Aloo Sadheko ', 'hhhhh', '2022-04-30'),
(29, 1, 'Jhol Momo ', 'fhgfhg', '2022-04-30'),
(30, 1, 'Jhol Momo ', 'hhh                                hhhhh                hhhh', '2022-04-30'),
(31, 1, 'Jhol Momo ', 'ggg gggg gggg\n\ngg', '2022-04-30'),
(32, 1, 'Jhol Momo ', 'hhhhh hhh hhh\n\nhhh', '2022-04-30'),
(33, 1, 'Jhol Momo ', 'fhgh ffff ffffgjf hjh', '2022-04-30'),
(34, 1, 'Jhol Momo ', 'hello sabin sir', '2022-04-30'),
(35, 1, 'Aloo Sadheko ', 'nice aloo sadheko i want more ok deliver fast ', '2022-05-01'),
(36, 1, 'Aloo Sadheko ', 'nice job ', '2022-05-11'),
(37, 1, 'Aloo Sadheko ', 'nice', '2022-05-15'),
(38, 1, 'Jhol Momo ', ' ', '2022-05-15'),
(39, 1, 'Jhol Momo ', ' ', '2022-05-15'),
(40, 1, 'Jhol Momo ', 'hghgjh', '2022-05-15'),
(41, 1, 'Jhol Momo ', 'hghjg', '2022-05-15'),
(42, 1, 'Jhol Momo ', 'ghhgfhg', '2022-05-15'),
(43, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(44, 1, 'Chicken Biryani ', 'its good though..', '2022-05-17'),
(45, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(46, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(47, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(48, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(49, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(50, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(51, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(52, 1, 'Chicken Biryani ', ' ', '2022-05-17'),
(53, 1, 'Chicken Biryani ', 'this is good stuff', '2022-05-17'),
(54, 1, 'Chicken Biryani ', '.', '2022-05-17'),
(55, 1, 'Chicken Biryani ', '\'', '2022-05-17'),
(56, 1, 'Chicken Biryani ', '\'', '2022-05-17'),
(57, 1, 'Chicken Biryani ', ',', '2022-05-17'),
(58, 1, 'Chicken Biryani ', '-', '2022-05-17'),
(59, 1, 'Chicken Biryani ', 'ty', '2022-05-17'),
(60, 1, 'Chicken Biryani ', 'i\'m done with this food.,', '2022-05-17'),
(61, 1, 'Chicken Biryani ', 'i\'m done with this food.,', '2022-05-17'),
(62, 1, 'Chicken Biryani ', 'is', '2022-05-17'),
(63, 1, 'Chicken Biryani ', ':this is best@&', '2022-05-17'),
(64, 1, 'Chicken Biryani ', '\'\'\'\'\'\'', '2022-05-17'),
(65, 1, 'Aloo Sadheko ', 'olallalalallala', '2022-05-24'),
(66, 1, 'Aloo Sadheko ', 'it has unique taste , i like it', '2022-05-26'),
(67, 1, 'Aloo Sadheko ', 'delicious ', '2022-05-26'),
(68, 1, 'Aloo Sadheko ', 'nicely seasoned with tangy taste..', '2022-05-26'),
(69, 1, 'Aloo Sadheko ', 'taste good ..', '2022-06-07'),
(70, 2, 'Aloo Sadheko ', 'taste gooooood', '2022-08-19'),
(71, 2, 'BBQ Chicken Pizza ', 'perfectly seasoned and loved the taste......', '2022-08-19'),
(72, 2, 'Cauliflower Wings ', 'perfectly seasoned and loved the taste......', '2022-08-19'),
(73, 2, 'Cauliflower Wings ', 'perfectly seasoned and loved the taste......', '2022-08-19'),
(74, 2, 'Cauliflower Wings ', 'very flavorful', '2022-08-19'),
(75, 2, 'Chicken Biryani ', 'best i have ever eaten', '2022-08-19'),
(76, 2, 'Egg Tikka Masala ', 'amazed by the thing that you get pretty large quantity', '2022-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`uid`, `firstname`, `lastname`, `email`, `contact`, `password`) VALUES
(1, 'helloo', 'hello', 'hello@gmail.com', '9894564545', 'f5ad74ad8ac432c4572d8ae64787d94d80933685'),
(2, 'john', 'wickk', 'john@gmail.com', '4566565655', 'f5ad74ad8ac432c4572d8ae64787d94d80933685'),
(3, '1z-2x-3c', '', 'admin@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'abcdefghijk', 'jlfglkj', 'jkfjgjfl', 'klfgkjfglj', 'f5ad74ad8ac432c4572d8ae64787d94d80933685'),
(5, 'aaaa', 'aaaa', 'a@aa.co', '3212321232', 'c190b5acc42be61f1b1377427a146c14576cb31d'),
(6, 'jfdhjkds', 'jfdhkjhd', 'sjh@gjhj.djh', '9841412121', '9ed9d337d31c4361aae2009f5cb43776e5b46d2f'),
(7, 'sam', 'bahadur', 'sam@gmail.com', '9898989767', '3bb99a770807a8f25e536d93fc014e3124f9949f'),
(8, 'sujata', 'sujata', 'sujata@gmail.com', '9898989897', 'f6a24795d6bec292ee190d7b0a2883c48e6999c7'),
(9, 'hari', 'hari', 'hari@gmail.com', '9898989896', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(10, 'nirmal', 'nirmal', 'nirmal@gmail.com', '9898989763', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(11, 'ram', 'ram', 'ram@gmail.com', '9898989892', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(12, 'anjana', 'anjana', 'anjana@gmail.com', '9898989764', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(13, 'aarav', 'aarav', 'aarav@gmail.com', '9898989766', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(14, 'ankit', 'ankit', 'ankit@gmail.com', '9898989895', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc'),
(15, 'garima', 'garima', 'garima@gmail.com', '9898989844', '2afbcf9cd4391aaad722822c9ccb94ed7fff64fc');

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `rating_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `rating_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`rating_id`, `uid`, `fid`, `rating`, `rating_date`) VALUES
(1, 7, 1, 5, '2024-08-14 15:25:43'),
(2, 7, 3, 4, '2024-08-14 15:25:43'),
(3, 7, 5, 3, '2024-08-14 15:25:43'),
(4, 7, 11, 4, '2024-08-14 15:25:43'),
(5, 7, 13, 5, '2024-08-14 15:25:43'),
(6, 8, 1, 4, '2024-08-14 15:25:43'),
(7, 8, 2, 5, '2024-08-14 15:25:43'),
(8, 8, 4, 3, '2024-08-14 15:25:43'),
(9, 8, 12, 4, '2024-08-14 15:25:43'),
(10, 8, 18, 5, '2024-08-14 15:25:43'),
(11, 9, 1, 3, '2024-08-14 15:25:43'),
(12, 9, 7, 5, '2024-08-14 15:25:43'),
(13, 9, 9, 4, '2024-08-14 15:25:43'),
(14, 9, 19, 5, '2024-08-14 15:25:43'),
(15, 9, 20, 4, '2024-08-14 15:25:43'),
(16, 10, 3, 5, '2024-08-14 15:25:43'),
(17, 10, 6, 4, '2024-08-14 15:25:43'),
(18, 10, 11, 5, '2024-08-14 15:25:43'),
(19, 10, 14, 3, '2024-08-14 15:25:43'),
(20, 10, 21, 4, '2024-08-14 15:25:43'),
(21, 11, 4, 5, '2024-08-14 15:25:43'),
(22, 11, 8, 4, '2024-08-14 15:25:43'),
(23, 11, 15, 3, '2024-08-14 15:25:43'),
(24, 11, 22, 5, '2024-08-14 15:25:43'),
(25, 11, 23, 4, '2024-08-14 15:25:43'),
(26, 12, 5, 5, '2024-08-14 15:25:43'),
(27, 12, 13, 4, '2024-08-14 15:25:43'),
(28, 12, 18, 5, '2024-08-14 15:25:43'),
(29, 12, 24, 3, '2024-08-14 15:25:43'),
(30, 12, 27, 4, '2024-08-14 15:25:43'),
(31, 13, 1, 4, '2024-08-14 15:25:43'),
(32, 13, 2, 5, '2024-08-14 15:25:43'),
(33, 13, 7, 4, '2024-08-14 15:25:43'),
(34, 13, 12, 5, '2024-08-14 15:25:43'),
(35, 13, 28, 3, '2024-08-14 15:25:43'),
(36, 14, 3, 5, '2024-08-14 15:25:43'),
(37, 14, 9, 4, '2024-08-14 15:25:43'),
(38, 14, 16, 5, '2024-08-14 15:25:43'),
(39, 14, 21, 4, '2024-08-14 15:25:43'),
(40, 14, 29, 3, '2024-08-14 15:25:43'),
(41, 15, 2, 4, '2024-08-14 15:25:43'),
(42, 15, 4, 5, '2024-08-14 15:25:43'),
(43, 15, 6, 4, '2024-08-14 15:25:43'),
(44, 15, 11, 5, '2024-08-14 15:25:43'),
(45, 15, 14, 3, '2024-08-14 15:25:43'),
(46, 13, 14, 4, '2024-08-16 15:57:15'),
(47, 13, 34, 4, '2024-08-16 15:57:25'),
(48, 13, 34, 4, '2024-08-16 16:23:32'),
(49, 12, 3, 4, '2024-08-16 16:35:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `fid` (`fid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4275;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `userinfo` (`uid`),
  ADD CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `food` (`fid`);

--
-- Constraints for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD CONSTRAINT `user_ratings_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `userinfo` (`uid`),
  ADD CONSTRAINT `user_ratings_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `food` (`fid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

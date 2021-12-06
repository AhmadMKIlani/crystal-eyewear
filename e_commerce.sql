-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(4, 'sunglasses', 'sunglasses for women, men, and kids.', '743425_1_1600x.png'),
(5, 'eyeglasses', 'eyeglasses for women, men, and kids.', '43925_1_1600x.png');

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `order_id` int(5) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_total_price` varchar(50) NOT NULL,
  `cart_after_shopping` longtext NOT NULL,
  `user_checkout` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `checkout_street_address` varchar(100) NOT NULL,
  `checkout_city` varchar(50) NOT NULL,
  `checkout_country` varchar(50) NOT NULL,
  `checkout_phone` int(14) NOT NULL,
  `checkout_total_price` int(10) NOT NULL,
  `date_of_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_id`, `order_status`, `order_total_price`, `cart_after_shopping`, `user_checkout`, `user_id`, `checkout_street_address`, `checkout_city`, `checkout_country`, `checkout_phone`, `checkout_total_price`, `date_of_creation`) VALUES
(10, 'pending', '193', '[{\"product_id\":\"44\",\"product_name\":\"Tom Ford FT0371 ANOUSHKA 01B\",\"product_description\":\"Only founded in 2005, Tom Ford has constructed an expansive fashion empire in an unbelievably short amount of time, revolutionising fashion with sharp designs that focus on the small details. The Tom Ford Anoushka sunglasses, on the other hand are anythin\",\"product_price\":\"242\",\"product_image\":\"46940product_1.jpg\",\"product_on_sale\":\"0\",\"product_best_seller\":\"0\",\"featured_products\":\"1\",\"product_sale_price\":\"0\",\"product_percentage_price\":\"20\",\"category_id\":\"4\",\"sub_category_id\":\"2\",\"product_quantity\":\"1\"}]', 0, 10, 'Shafa', 'Amman', 'Jordan', 795102339, 0, '2021-12-06 16:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_on_sale` tinyint(1) NOT NULL DEFAULT 0,
  `product_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `featured_products` tinyint(1) NOT NULL DEFAULT 0,
  `product_sale_price` int(10) DEFAULT NULL,
  `product_percentage_price` int(10) DEFAULT NULL,
  `category_id` int(5) NOT NULL,
  `sub_category_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_image`, `product_on_sale`, `product_best_seller`, `featured_products`, `product_sale_price`, `product_percentage_price`, `category_id`, `sub_category_id`) VALUES
(44, 'Tom Ford FT0371 ANOUSHKA 01B', 'Only founded in 2005, Tom Ford has constructed an expansive fashion empire in an unbelievably short amount of time, revolutionising fashion with sharp designs that focus on the small details. The Tom Ford Anoushka sunglasses, on the other hand are anythin', 242, '46940product_1.jpg', 0, 0, 1, 0, 20, 4, 2),
(45, 'SmartBuy Collection Brette SB-928D', 'These Brette sunglasses come in a stylish Gold , paired with fantastic Brown lenses to give you a great look for this season. The frame is made of Metal , while the lenses are made of durable and high-grade Plastic . SmartBuy Collection Brette sunglasses ', 39, '94813544491_1618571905448.jpg', 0, 1, 0, NULL, 70, 4, 2),
(46, 'Ray-Ban RB3016 Clubmaster W0366', 'Did you know that you can transform your style from ordinary to creative, unique,  and fashionable in just a few seconds? The Ray-Ban RB3016 Clubmaster has these seemingly  magical qualities that can instantly give you a great sense of fashion, intrigue, ', 161, '7734752168_1599492409983.jpg', 0, 1, 1, NULL, 10, 4, 2),
(47, 'Ray-Ban RB3025 Aviator Gradient 001/51', 'Founded in 1937, Ray Ban offers almost 100 years of expertise with designing the perfect  sunglasses with the Aviators and Wayfarer being the two most iconic designs. Ray Ban has  been the go to brand for many years when you want to make sure that you loo', 176, '9214452178_1599492623850.jpg', 0, 1, 1, NULL, 10, 4, 2),
(48, 'SmartBuy Collection Skye SS-CP121E', 'SmartBuy Collection Skye sunglasses are great for any occasion. The perfect color combination  of Milky Tortoise and Smoke Grey make this pair a great addition to any outfit. Made from  Injected Plastic and with a 2 year warranty, these stylish sunglasses', 39, '24903544538_1622173969566.jpg', 0, 0, 0, NULL, 50, 4, 2),
(49, 'SmartBuy Collection Reeses SS-915E', 'Want to update your look? Grab a pair of these fantastic SmartBuy Collection Reeses  sunglasses in Silver . Order your SmartBuy Collection Reeses sunglasses from SmartBuyGlasses  and know that you have a 24 month backed warranty.', 39, '89562544524_1622173969556.jpg', 0, 0, 1, NULL, 0, 4, 2),
(50, 'Arise Collective Thiva 95249 C1', 'The stylish Arise Collective Thiva sunglasses are made with the finest materials  and superior craftsmanship. The frame is made from a classic Plastic whilst the lenses  are made of durable and high grade Grey . UV protection Cat 2 and above is offered fo', 59, '85971530496_1599509874533.jpg', 0, 0, 1, NULL, 0, 4, 4),
(52, 'Ray-Ban RB3025 Aviator L2823', 'Founded in 1937, Ray Ban offers almost 100 years of expertise with designing the perfect  sunglasses with the Aviators and Wayfarer being the two most iconic designs. Ray Ban has  been the go to brand for many years when you want to make sure that you look up to date.  This timeless and classic Ray-Ban product is a pair of iconic sunglasses that will stay in  style for a long time.  The Ray Ban RB3025 Aviator Flash Lenses comes with a metal frame and we offer them in a vast  variety of colors. When you order with SmartBuyGlasses you will get free and fast shipping  as well as an amazing 24-month warranty.', 161, '5987519153_1599492703268.jpg', 0, 0, 0, NULL, 10, 4, 4),
(53, 'Carrera GRAND PRIX 2 807/HA', 'Designed with a timeless aviator shape and made for living life on the edge, the Carrera Grand  Prix 2 sunglasses function and form are crafted for longevity. Fused with gradient lens tech  that guarantees powerful UV protection lenses, this pair of Carrera sunglasses easily brings  together style and innovation. The pilot shape sunglasses come in a range of colors and are  crafted from shatter resistant plastic.The frames of the Carrera Grand PRIX 2 are black and  white, which make it possible for you to combine them with any outfit. Whether you feel like  going casual or street style, the Carrera Grand Prix 2 will add a fiery confidence to your  urban-inspired look all season long. So, amplify your style by purchasing a new pair of these  Carrera sunglasses - whether you are going casual or street style they will always complete  your look.', 115, '2469537198_1617770058751.jpg', 0, 0, 0, NULL, 10, 4, 4),
(54, 'Carrera GRAND PRIX 2 807/HA', 'Designed with a timeless aviator shape and made for living life on the edge, the Carrera Grand  Prix 2 sunglasses function and form are crafted for longevity. Fused with gradient lens tech  that guarantees powerful UV protection lenses, this pair of Carrera sunglasses easily brings  together style and innovation. The pilot shape sunglasses come in a range of colors and are  crafted from shatter resistant plastic.The frames of the Carrera Grand PRIX 2 are black and  white, which make it possible for you to combine them with any outfit. Whether you feel like  going casual or street style, the Carrera Grand Prix 2 will add a fiery confidence to your  urban-inspired look all season long. So, amplify your style by purchasing a new pair of these  Carrera sunglasses - whether you are going casual or street style they will always complete  your look.', 115, '65384179417_1599493486155.jpg', 0, 0, 1, NULL, 10, 4, 4),
(56, 'Polaroid PLD8041/S Kids 2X6/M9', 'Polaroid is a company that generates innovation. It was established by Edwin Land who invented a  trend that changed the game in the eyewear industry. Such trends allowed the brand to feature  budget products with superb functionality.  The PLD8041/S Kids is a cheap yet functional pair of sunglasses for Kids. They feature a simple  design that can complement many outfits.  These Polaroid Sunglasses are made from a high-quality Polycarbonate for durability and comfort  -- they are light, strong, and hypoallergenic. The non-slip temples and integrated nose pads  will prevent wobble while the optical hinges will provide a nice fit.  Moreover, the Plastic comes with patented technology that prevents glare on glasses for improved  vision. They are one of the best polarized fishing sunglasses on the market.  They are also available in a variety of color options.  Along with the best and affordable glasses, we at SmartBuyGlasses also provide a 24-month  warranty, a 100-day return policy, and loyalty programs to our beloved customers.', 53, '16549562276_1625201284267.jpg', 0, 0, 0, NULL, 10, 4, 3),
(57, 'Ray-Ban Kids RJ9062S 707680', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 77, '61808557178_1618908611977.jpg', 0, 0, 0, NULL, 10, 4, 3),
(58, 'Ray-Ban Kids RJ9000S 707690', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 70, '79235557180_1618908611977.jpg', 0, 0, 0, NULL, 10, 4, 3),
(59, 'Ray-Ban Kids RJ989256 gg5', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 77, '29204540245_1607492765851.jpg', 0, 0, 0, NULL, 10, 4, 3),
(60, 'Ray-Ban Kids RJ9062S 8080ER', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 80, '87181541942_1606272601909.jpg', 0, 0, 0, NULL, 0, 4, 3),
(61, 'Polaroid PLD8041/S Kids 2X6/654', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 88, '29786537864_1603243186801.jpg', 0, 0, 0, NULL, 10, 4, 3),
(62, 'Ray-Ban Kids RJ9062S 707680', 'The stylish Ray Ban Kids Ray-Ban Kids RJ9062S sunglasses are made with the finest materials and  superior craftsmanship. The frame is made from a classic Plastic whilst the lenses are made of  durable and high grade Grey . UV protection Cat 2 and above is offered for all sunglasses to  strong ensure protection all day. All Arise Collective sunglasses come with a 2 year guarantee,  100 free return and a durable sunglasses case and cloth.', 77, '21359403501_1605228497520.jpg', 0, 0, 0, NULL, 0, 5, 21),
(63, 'SmartBuy Kids Jukesc K6A', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 35, '40716446073_1599537311265.jpg', 0, 0, 0, NULL, 0, 5, 21),
(64, 'SmartBuy Kids Little Eleanor Blue-Light Block PK10', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 35, '38231552825_1629342902913.jpg', 0, 0, 0, NULL, 0, 5, 21),
(65, 'Oakley OX8080 CROSSLINK ZERO Asian Fit 808004', 'The Oakley eyeglasses collection includes a wide range of attractive styles. The Oakley OX8080  CROSSLINK ZERO Asian Fit frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Oakley , 2-year  warranty, and the best price guarantee when you shop with us.', 163, '5758322888_1599533865831.jpg', 0, 0, 0, NULL, 0, 5, 26),
(66, 'Tom Ford FT5663-B Blue-Light Block 001', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 191, '74627509287_1603462107968.jpg', 0, 0, 0, NULL, 0, 5, 26),
(67, 'Oakley OX8076 CROSSLINK ZERO 807607', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 163, '14616333383_1599533847322.jpg', 0, 0, 0, NULL, 0, 5, 26),
(68, 'SmartBuy Collection Adora Blue-Light Block Asian F', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 50, '53170528930_1614580725988.jpg', 0, 0, 1, NULL, 0, 5, 20),
(69, 'SmartBuy Collection Beau Asian Fit 686', 'The Tom Ford eyeglasses collection includes a wide range of attractive styles. The Tom Ford  FT5663-B Blue-Light Block frame is made of Plastic and comes in a range of stylish colors.  Optional prescription lenses, fitted by our in-house professionals can be included at a  fantastic price, meaning that your glasses are ready to go as soon as they arrive, no trips to  the optometrist required!. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 30, '67715213721_1599532730040.jpg', 0, 0, 0, NULL, 0, 5, 26),
(70, 'SmartBuy Collection Scout Asian Fit M5C', 'Choose these SmartBuy Collection Scout Asian Fit eyeglasses for any day of the week. These frames  are a great fit with their Silver color. Made from Metal and with an extended 24 month warranty  from SmartBuyGlasses , these eyeglasses can be used anywhere and anytime. Optional single vision,  bi-focal, multi-focal or progressive lenses are also offered for these glasses at a low price.  Discover over 180 designer eyewear brands and more than 80,000 eyeglasses at SmartBuyGlasses !  Plus, enjoy free shipping, free 1.5 lenses for SmartBuy Collection , 2-year warranty, and the  best price guarantee when you shop with us.', 30, '88756426600_1599532591786.jpg', 0, 0, 0, NULL, 0, 5, 20),
(71, 'SmartBuy Collection Chade CP123C', 'The SmartBuy Collection glasses collection includes a huge range of styles, including Chade  glasses which are great for office and leisure. SmartBuy Collection Chade eyeglasses come in  a variety of frame colors, these are Transparent Pink and made from Injected Plastic . Easily  correct your vision by adding our customizable RX lenses package to these great frames with  optional tints and coatings. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for SmartBuy  Collection , 2-year warranty, and the best price guarantee when you shop with us', 35, '92879545087_1621916703563.jpg', 0, 0, 0, NULL, 0, 5, 20),
(72, 'Tom Ford FT5664-B Blue-Light Block 001', 'Tom Ford FT5664-B Blue-Light Block glasses come with a sturdy Plastic frame. The SmartBuyGlasses  prescription lenses option is a great choice so your eyeglasses arrive on your doorstep ready  to wear. Our lenses are coated with a special advanced coating which renders them anti-glare and  scratch resistant. The Tom Ford FT5664-B Blue-Light Block eyeglasses feature a Glossy Black  frame and standard lenses. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 191, '9520531825_1606803868540.jpg', 0, 0, 0, NULL, 70, 5, 20),
(73, 'SmartBuy Collection Chade CP123', 'Tom Ford FT5664-B Blue-Light Block glasses come with a sturdy Plastic frame. The SmartBuyGlasses  prescription lenses option is a great choice so your eyeglasses arrive on your doorstep ready  to wear. Our lenses are coated with a special advanced coating which renders them anti-glare and  scratch resistant. The Tom Ford FT5664-B Blue-Light Block eyeglasses feature a Glossy Black  frame and standard lenses. Discover over 180 designer eyewear brands and more than 80,000  eyeglasses at SmartBuyGlasses ! Plus, enjoy free shipping, free 1.5 lenses for Tom Ford ,  2-year warranty, and the best price guarantee when you shop with us.', 30, '67105545084_1621492173325.jpg', 0, 0, 0, NULL, 0, 5, 20),
(74, 'Arise Collective Ione Blue-Light Block YC-28019 C4', ' Arise Collective glasses are made with the finest materials and superior craftsmanship. The Ione  Blue-Light Block come with an exception quality Transparent Faded Purple Plastic frame. Each  pair of eyeglasses from Arise Collective are classic frames shapes with a modern twist. All  eyeglasses in the Arise Collective collection include free prescription lenses with a special  advanced coating which renders them anti-glare and scratch resistant. In addition, all frames  come with a 2-year warranty, Arise collective case and cloth and 100 days free return.', 60, '53709559124_1623115724299.jpg', 0, 0, 1, NULL, 10, 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` int(5) NOT NULL,
  `review_title` varchar(50) NOT NULL,
  `review_rating` varchar(50) NOT NULL,
  `review_comments` varchar(500) NOT NULL,
  `product_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`review_id`, `review_title`, `review_rating`, `review_comments`, `product_id`, `user_id`, `date_created`) VALUES
(1, 'Very bad', '', 'the [regofmk, ', 45, 16, '2021-12-06 16:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(5) NOT NULL,
  `sub_category_name` varchar(50) NOT NULL,
  `sub_category_description` varchar(255) NOT NULL,
  `sub_category_image` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `sub_category_name`, `sub_category_description`, `sub_category_image`, `category_id`) VALUES
(2, 'sunglasess women', 'gdfgtr', '3849diff-june-2021-female-on-model-Sun-Camden-d_1080x.jpg', 4),
(3, 'sunglasess kids', 'gdfgtr', '5380cute-kids-with-big-sunglasses-big-smiles.jpg', 4),
(4, 'sunglasess men', 'dsfadsf', '302DALSTON-BLUE-TORTOISE-FRONT_900x.jpg', 4),
(20, 'eyeglasess women', 'e.smith@kpmg.com.au', '4025Gracia_LightHavana_34_Woman_c6bf4ca9-d514-4250-ab8a-b0ec3bf78cac_900x.jpg', 5),
(21, 'eyeglasess kids', 'e.smith@kpmg.com.au', '8142dalston_girl_tortoise_3-4_9d497de5-991e-4ab0-912b-903a0309b59f_900x.jpg', 5),
(26, 'eyeglasess man', 'e.smith@kpmg.com.au', '6417Shoreditch_blue_havana_man_front_b996f756-74a3-4c80-b415-b7a07ce35207_900x.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `image`, `role`, `full_name`) VALUES
(5, 'Abdallh Samman', 'abdall.samman@gmail.com', '235f2e61ce2713dc462fbea6f6d0bc06', '', '', ''),
(10, 'abdallhh', 'abdallhh.samman@gmail.com', '2ca8a24b2238bc9e9800398c707eb91e', '', '', 'abdallhh'),
(12, 'awni', 'alrifai@gmail.com', 'Awnirifai@2020', '91243', '1', ''),
(15, 'awniRifai', 'awni.rifai1998@gmail.com', '71dde1e8044b58eb46a59f68ef1ce3f3', '', '1', ''),
(16, 'awnirif', 'alrifai.awni98@gmail.com', '722e7450dc0c64c5e87ed11ed2c0ab99', '', '', 'awni');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_summary_ibfk_1` (`user_checkout`),
  ADD KEY `order_summary_ibfk_2` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_review_ibfk_1` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `sub_category_ibfk_1` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `review_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD CONSTRAINT `order_summary_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`sub_category_id`);

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

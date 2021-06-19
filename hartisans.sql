CREATE DATABASE IF NOT EXISTS `hartisans` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hartisans`;

CREATE TABLE `blocked` (
  `email` varchar(60) NOT NULL,
  `attempts` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `likes` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `products` (
  `sr_no` int(11) NOT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `category` char(1) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateEdited` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `img1` varchar(37) DEFAULT NULL,
  `img2` varchar(37) DEFAULT NULL,
  `img3` varchar(37) DEFAULT NULL,
  `img4` varchar(37) DEFAULT NULL,
  `img5` varchar(37) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `resetpassword` (
  `process` varchar(32) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `temp` (
  `type` char(1) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `fn` varchar(15) DEFAULT NULL,
  `ln` varchar(15) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `process` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `transactions` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) DEFAULT 0,
  `trans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `type` char(1) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `fn` varchar(15) DEFAULT NULL,
  `ln` varchar(15) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `ph_no` varchar(10) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `views` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `blocked`
  ADD PRIMARY KEY (`email`);


ALTER TABLE `likes`
  ADD KEY `sr_no` (`sr_no`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`process`);


ALTER TABLE `temp`
  ADD PRIMARY KEY (`process`);


ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `sr_no` (`sr_no`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `views`
  ADD KEY `sr_no` (`sr_no`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `products`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

GRANT ALL ON hartisans.* TO 'EnterUserName'@'localhost' IDENTIFIED BY 'EnterPassword';
GRANT ALL ON hartisans.* TO 'EnterUserName'@'127.0.0.1' IDENTIFIED BY 'EnterPassword';
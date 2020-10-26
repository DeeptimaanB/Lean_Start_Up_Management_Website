CREATE DATABASE IF NOT EXISTS `hartisans` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hartisans`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(1) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `fn` varchar(15) DEFAULT NULL,
  `ln` varchar(15) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `ph_no` varchar(10) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
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
  `process` varchar(32) NOT NULL,
  PRIMARY KEY (`process`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `blocked` (
  `email` varchar(60) NOT NULL,
  `attempts` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `resetpassword` (
  `process` varchar(32) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`process`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
  `sr_no` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(10) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `category` char(1) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateEdited` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  PRIMARY KEY(`sr_no`),
  CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `views` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  CONSTRAINT FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `likes` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  CONSTRAINT FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `transactions` (
  `sr_no` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) DEFAULT 0,
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`trans_id`),
  CONSTRAINT FOREIGN KEY (`sr_no`) REFERENCES `products` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

GRANT ALL ON hartisans.* TO 'EnterUserName'@'localhost' IDENTIFIED BY 'EnterPassword';
GRANT ALL ON hartisans.* TO 'EnterUserName'@'127.0.0.1' IDENTIFIED BY 'EnterPassword';

COMMIT;

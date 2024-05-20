CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,	
  `password` char(192) NOT NULL,
  `registration_date` DATETIME NOT NULL,
  `image_path` varchar(255) DEFAULT 'application/images/default.jpg',
  `user_type` ENUM('N','M') DEFAULT 'N',
  `number_of_questions` int NOT NULL DEFAULT 0,
  `number_of_answers` int NOT NULL DEFAULT 0,
  `rating` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE `questions` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,	
  `content` varchar(4096) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date_posted` DATETIME NOT NULL,
  PRIMARY KEY (`question_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `tags` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`),
  FOREIGN KEY (`question_id`) REFERENCES `questions`(`question_id`)
);

CREATE TABLE `answers` (
  `answer_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `user_id` int NOT NULL,	
  `content` varchar(4096) NOT NULL,
  `rating` smallint NOT NULL,
  `date_posted` DATETIME NOT NULL,
  PRIMARY KEY (`answer_id`),
  FOREIGN KEY (`question_id`) REFERENCES `questions`(`question_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
);

CREATE TABLE `voted` (
  `vote_id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `user_id` int NOT NULL,	
  `answer_id` int NOT NULL,
  `vote` ENUM('Up','Down') NOT NULL,
  PRIMARY KEY (`vote_id`),
  FOREIGN KEY (`question_id`) REFERENCES `questions`(`question_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`),
  FOREIGN KEY (`answer_id`) REFERENCES `answers`(`answer_id`)
);

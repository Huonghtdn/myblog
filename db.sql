drop table posts;
drop table comment;
drop table categories;
create TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` text not null,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`,`image`, `author`) VALUES
(1, 1, 'abnjbhfjkhjb','hihi','1.png', 'hjkhkjh'),
(2, 5, 'ohiuihi', 'hehe','3.png','vhvh'),
(3, 6, 'bjnbj', 'huhu','2.png', 'jk');

create table `comment`(
`id` int (11) not null auto_increment,
`author_comment` text not null,
`comment_at` datetime not null DEFAULT CURRENT_TIMESTAMP,
`body_comment` text not null,
`post_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
);

insert into `comment` (`id`, `author_comment`, `body_comment`, `post_id`) values
(1, 'Taytay', 'Post is interested', 1),
(2, 'Taytay', 'Post is awesome', 3),
(3, 'Taytay', 'Post is so cute', 2);

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technology'),
(2, 'Gaming'),
(3, 'Auto'),
(4, 'Entertainment'),
(5, 'Books');

DROP DATABASE IF EXISTS finalproject;
CREATE DATABASE finalproject;
USE finalproject;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(35) NOT NULL default '',
  `lastname` varchar(32) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `date_joined`datetime,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default '',
  `description` text(1000) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  `priority` varchar(26) NOT NULL default '',
  `status` varchar(32) NOT NULL default '',
  `assigned_to` int(11) default NULL,
  `created_by` int(11),
  `created` datetime,
  `updates` datetime,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `users`(firstname, lastname, `password`,email,date_joined) VALUES ('admin','admin', 'password123', 'admin@project2.com', NOW());
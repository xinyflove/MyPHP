-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-05-25 15:12:40
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytest`
--

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `from` varchar(20) NOT NULL,
  `dateline` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author`, `from`, `dateline`) VALUES
(2, '测试博客1', '<p><s><strong>事发楼房间撒娇绿色flak&nbsp;</strong></s></p>\r\n', 'peak', 'my news', 1431061351),
(3, '标题2', '<p>撒发生了房间啊酸辣粉机离开家</p>\r\n', 'peak2', '我的博客', 1431061370),
(4, '标题3', '<p>舒服撒发生</p>\r\n', '虽说', '而温柔', 1431062557),
(5, 'mvc244', '<p>就看上了飞机升空间发生开裂</p>\r\n', 'peak7', 'test1', 1431341992);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(32) NOT NULL,
  `upasswd` varchar(50) CHARACTER SET ascii NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `ulogintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `uname`, `upasswd`, `mobile`, `ulogintime`) VALUES
(1, 'test1', '202cb962ac59075b964b07152d234b70', '15653621610', '2015-04-20 02:54:05'),
(2, 'test3', '202cb962ac59075b964b07152d234b70', '2313131232', '2015-04-20 02:22:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

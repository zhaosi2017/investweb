-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-08 23:54:42
-- 服务器版本： 5.7.18
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `investweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(64) DEFAULT NULL,
  `password` varchar(64) NOT NULL DEFAULT '',
  `account` text,
  `nickname` text,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remark` text,
  `login_ip` varchar(64) NOT NULL DEFAULT '',
  `create_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `create_at` int(11) DEFAULT '0',
  `update_at` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
--账号admin@one, admin@123
--
INSERT INTO `admin` (`id`, `auth_key`, `password`, `account`, `nickname`, `status`, `remark`, `login_ip`, `create_id`, `update_id`, `create_at`, `update_at`) VALUES
(1, '0e2Gglmn7GjxbhsTamBi-oAQROyyGz6O', '$2y$13$mzYNon/zzR/70WDC3.cwNuZ4AQ47vPL/mmq904JJuVzRLWofTW5iy', 'z8BrRCkb9inlRiX8yKWTijk2NmY1ZjcyOWIyOTRlOThjNGYxMGJhNzMzMzM3NzY0NmM0YjcyYjYwZWY2MTU5ZDUwZTUwODA3M2E2ZjE4YzF4+fbKDp0YFH2rTpD31CgW9xqIw67UP53pNXc2R8YHrQ==', '超级管理员', 0, NULL, '', 1, 1, 1504886643, 1504886643);

-- --------------------------------------------------------

--
-- 表的结构 `alipay`
--

CREATE TABLE `alipay` (
  `id` int(11) NOT NULL,
  `systime` varchar(100) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `account` text,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `alipay-warn`
--

CREATE TABLE `alipay-warn` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_at` int(11) NOT NULL,
  `opreate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin/create', 2, '创建用户', NULL, NULL, 1503593524, 1503593524),
('admin/delete', 2, '删除用户', NULL, NULL, 1503593524, 1503593524),
('admin/index', 2, '用户列表', NULL, NULL, 1503593524, 1503593524),
('admin/login-logs', 2, '用户登陆日志列表', NULL, NULL, NULL, NULL),
('admin/trash', 2, '用户垃圾筒', NULL, NULL, 1503593524, 1503593524),
('admin/update', 2, '更新用户', NULL, NULL, 1503593524, 1503593524),
('administrator', 1, '超级管理员', NULL, NULL, NULL, NULL),
('alipay/add', 2, '添加搜索预警信息', NULL, NULL, 1504885888, 1504885888),
('alipay/create', 2, '支付宝预警->导入文件', NULL, NULL, 1504885930, 1504885930),
('alipay/index', 2, '支付列表', NULL, NULL, 1504885840, 1504885840),
('alipay/one-search', 2, '支付宝预警->一键搜索', NULL, NULL, 1504886045, 1504886045),
('authitem/auth', 2, '角色权限分配', NULL, NULL, 1503593524, 1503593524),
('authitem/create-privilege', 2, '新增权限', NULL, NULL, 1503593524, 1503593524),
('authitem/delete', 2, '删除角色', NULL, NULL, 1503593524, 1503593524),
('authitem/index', 2, '角色列表', NULL, NULL, 1503593524, 1503593524),
('authitem/update', 2, '编辑角色', NULL, NULL, 1503593524, 1503593524),
('authitem/user-role', 2, '用户角色分配', NULL, NULL, 1503593524, 1503593524),
('invest/create', 2, '新增协查信息', NULL, NULL, 1504888528, 1504888528),
('invest/index', 2, '协查信息列表', NULL, NULL, NULL, NULL),
('userManager', 1, '用户管理员', NULL, NULL, 1503593524, 1503593524);
-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `invest`
--

CREATE TABLE `invest` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增ID',
  `instance_number` varchar(100) NOT NULL COMMENT '实例编号',
  `system_number` varchar(100) NOT NULL COMMENT '系统编号',
  `instance_name` varchar(100) NOT NULL COMMENT '实例名',
  `filing_unit` varchar(100) NOT NULL COMMENT '立案单位',
  `filing_province` varchar(30) NOT NULL COMMENT '立案省份',
  `instance_detail` text NOT NULL COMMENT '实例详情',
  `case_person` varchar(50) NOT NULL COMMENT '办案人员',
  `charge_person` varchar(100) NOT NULL COMMENT '负责人',
  `phone` varchar(50) NOT NULL COMMENT '联系方式',
  `filing_time` int(10) UNSIGNED NOT NULL COMMENT '立案时间',
  `add_time` int(10) UNSIGNED NOT NULL COMMENT '添加时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='协查信息';

-- --------------------------------------------------------

--
-- 表的结构 `manager_login_logs`
--

CREATE TABLE `manager_login_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `login_time` datetime NOT NULL,
  `login_ip` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alipay`
--
ALTER TABLE `alipay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alipay-warn`
--
ALTER TABLE `alipay-warn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_login_logs`
--
ALTER TABLE `manager_login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `alipay`
--
ALTER TABLE `alipay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `alipay-warn`
--
ALTER TABLE `alipay-warn`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `manager_login_logs`
--
ALTER TABLE `manager_login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

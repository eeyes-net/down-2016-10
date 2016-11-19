CREATE DATABASE IF NOT EXISTS `test_down` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `test_down`;

CREATE TABLE IF NOT EXISTS `down_list` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增序号',
  `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '软件名称',
  `icon_path` VARCHAR(2048) NOT NULL DEFAULT '' COMMENT '图标相对路径',
  `win_id` INT NOT NULL DEFAULT '0' COMMENT 'Windows版的外键',
  `mac_id` INT NOT NULL DEFAULT '0' COMMENT 'Mac版的外键',
  `desc` VARCHAR(2048) NOT NULL DEFAULT '' COMMENT '软件描述',
  `order` INT NOT NULL DEFAULT '32767' COMMENT '排序',
  `enabled` TINYINT NOT NULL DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = MyISAM CHARSET = utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `down_file` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增序号',
  `name_md5` CHAR(32) NOT NULL COMMENT '路径的索引',
  `path` VARCHAR(2048) NOT NULL COMMENT '文件相对路径',
  `size` INT NOT NULL COMMENT '文件大小',
  `version` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '文件版本',
  `enabled` TINYINT NOT NULL DEFAULT '1' COMMENT '是否禁用',
  PRIMARY KEY (`id`),
  UNIQUE (`name_md5`)
) ENGINE = MyISAM CHARSET = utf8 COLLATE utf8_general_ci;

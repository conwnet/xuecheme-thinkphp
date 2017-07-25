
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(255) DEFAULT '',
  `password` VARCHAR(255) DEFAULT '',

  `name` VARCHAR(127) DEFAULT '',
  `age` INTEGER DEFAULT 0,
  `sex` INTEGER DEFAULT 0,
  `email` VARCHAR(255) DEFAULT '',
  `country` VARCHAR(127) DEFAULT '',
  `province` VARCHAR(127) DEFAULT '',
  `city` VARCHAR(127) DEFAULT '',
  `headimg` VARCHAR(511) DEFAULT '',
  `id_card` VARCHAR(127) DEFAULT '',
  `status` INTEGER DEFAULT 1,

  `openid` VARCHAR(255) DEFAULT '',
  `access_token` VARCHAR(255) DEFAULT '',
  `access_time_out` BIGINT DEFAULT 0
);

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `ssid` VARCHAR(255) PRIMARY KEY DEFAULT '',
  `time_out` BIGINT DEFAULT 0,
  `user_id` INTEGER DEFAULT 0,
  `sms_mobile` VARCHAR(255) DEFAULT '',
  `sms_code` VARCHAR(255) DEFAULT '',
  `sms_time_out` VARCHAR(255) DEFAULT ''
);

DROP TABLE IF EXISTS `school`;
CREATE TABLE `school` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT '',
  `province` VARCHAR(255) DEFAULT '',
  `city` VARCHAR(255) DEFAULT '',
  `address` VARCHAR(255) DEFAULT '',
  `gps_city` VARCHAR(511) DEFAULT '',
  `headimg` VARCHAR(511) DEFAULT '',
  `banners` VARCHAR(2047) DEFAULT '[]',
  `score` REAL DEFAULT 5,
  `count` INTEGER DEFAULT 0,
  `status` INTEGER DEFAULT 1,
  `desc` VARCHAR(1023) DEFAULT ''
);

INSERT INTO `school` (name, province, city, `address`, `headimg`, banners, `desc`) VALUES (
  '秣马驾校', '辽宁', '沈阳', '沈阳市沈北新区道义南大街 47 号', 'http://placehold.it/80x80',
  '["http://placehold.it/400x150", "http://placehold.it/400x150"]', '沈阳航空航天大学秣马驾校');

DROP TABLE IF EXISTS `package`;
CREATE TABLE `package` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `school_id` INTEGER DEFAULT 0,
  `price` INTEGER DEFAULT 0,
  `title` VARCHAR(255) DEFAULT '',
  `headimg` VARCHAR(255) DEFAULT '',
  `count` INTEGER DEFAULT 0,
  `status` INTEGER DEFAULT 1,
  `desc` VARCHAR(1023) DEFAULT ''
);

INSERT INTO `package` (school_id, price, title, headimg, count, status, `desc`) VALUES (
  1, 888, '实惠套餐', 'http://placehold.it/80x80', 1, 1, '价格实惠，帮您快速拿证！'
);
INSERT INTO `package` (school_id, price, title, headimg, count, status, `desc`) VALUES (
  1, 1388, 'VIP套餐', 'http://placehold.it/80x80', 1, 1, 'VIP 套餐，帮您极速拿证！'
);

DROP TABLE IF EXISTS `coach`;
CREATE TABLE `coach` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `user_id` INTEGER DEFAULT 0,
  `school_id` INTEGER DEFAULT 0,
  `type` INTEGER DEFAULT 2,
  `banners` VARCHAR(2047) DEFAULT '[]',
  `score` REAL DEFAULT 5,
  `price` INTEGER DEFAULT 0,
  `desc` VARCHAR(512) DEFAULT ''
);

INSERT INTO `user` (username, name) VALUES ('13032405630', '张教练');
INSERT INTO `user` (username, name) VALUES ('13032405631', '李教练');

INSERT INTO `coach` (user_id, school_id, type, score, `price`, `desc`) VALUES (
  1, 1, 2, 5, 80, '快来学车吧~让我看看你是不是老司机！'
);

INSERT INTO `coach` (user_id, school_id, type, score, `price`, `desc`) VALUES (
  2, 1, 3, 5, 90, '快来学车吧~让我看看你是不是小司机！'
);

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `coach_id` INTEGER DEFAULT 0,
  `stu_id` INTEGER DEFAULT 0,
  `type` INTEGER DEFAULT 0,
  `year` INTEGER DEFAULT 0,
  `month` INTEGER DEFAULT 0,
  `date` INTEGER DEFAULT 0,
  `begin` INTEGER DEFAULT 0,
  `end` INTEGER DEFAULT 0,
  `price` INTEGER DEFAULT 0
);
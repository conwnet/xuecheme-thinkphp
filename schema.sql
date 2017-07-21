
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
  `headimgurl` VARCHAR(511) DEFAULT '',
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
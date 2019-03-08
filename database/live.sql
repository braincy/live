# 球队表
CREATE TABLE `live_team` (
  `id` tinyint(1) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

# 直播表
CREATE TABLE `live_game` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `a_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `b_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `a_score` int(10) unsigned NOT NULL DEFAULT 0,
  `b_score` int(10) unsigned NOT NULL DEFAULT 0,
  `narrator` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `start_time` int(10) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

# 球员表
CREATE TABLE `live_player` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `age` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `position` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  `update_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

# 赛况表
CREATE TABLE `live_outs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `game_id` int(10) unsigned NOT NULL DEFAULT 0,
  `team_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `content` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

# 聊天室表
CREATE TABLE `live_chat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `game_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `content` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `create_time` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
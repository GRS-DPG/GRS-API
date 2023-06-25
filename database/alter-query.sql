-- Nid Log Table  (Shuvo) - sep-7-2022 ----
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `nid_log`
-- ----------------------------
DROP TABLE IF EXISTS `nid_log`;
CREATE TABLE `nid_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) DEFAULT NULL,
  `training_institute_id` int(11) DEFAULT NULL,
  `course_info_id` int(11) DEFAULT NULL,
  `batch_info_id` int(11) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `nid` varchar(24) DEFAULT NULL,
  `request_time` datetime DEFAULT NULL,
  `request_ip` varchar(32) DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `modified_by` varchar(36) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `entity_id_2` (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=811126 DEFAULT CHARSET=utf8;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for chal
-- ----------------------------
DROP TABLE IF EXISTS `chal`;
CREATE TABLE `chal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chal
-- ----------------------------
INSERT INTO `chal` VALUES (1, 'Example Post', 'You');
INSERT INTO `chal` VALUES (2, 'Example Post II', 'Are Looking ');
INSERT INTO `chal` VALUES (3, 'Example Post III', 'In Wrong Place');

-- ----------------------------
-- Function structure for give_me_flag
-- ----------------------------
DROP FUNCTION IF EXISTS `give_me_flag`;
delimiter ;;
CREATE FUNCTION `give_me_flag`()
 RETURNS varchar(255) CHARSET latin1
BEGIN
	RETURN '6c6173746374667b73716c316e6a33637431306e5f6a7535745f6630725f66756e7d';
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

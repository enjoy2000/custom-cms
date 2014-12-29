INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (1,NULL,'guest');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (2,1,'user');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (3,2,'moderator');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (4,3,'administrator');

INSERT INTO `custom_cms`.`Locale` (`name`) VALUES ('en_US');
INSERT INTO `custom_cms`.`Locale` (`name`) VALUES ('ar_IQ');

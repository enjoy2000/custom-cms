INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (1,NULL,'guest');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (2,1,'user');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (3,2,'moderator');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (4,3,'administrator');

INSERT INTO `Locale` (`id`,`name`,`code`) VALUES (1,'English','en_US');
INSERT INTO `Locale` (`id`,`name`,`code`) VALUES (2,'Arabic','ar_IQ');

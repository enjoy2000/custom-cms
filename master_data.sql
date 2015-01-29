INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (1,NULL,'guest');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (2,1,'user');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (3,2,'moderator');
INSERT INTO `role` (`id`,`parent_id`,`roleId`) VALUES (4,3,'administrator');

INSERT INTO `Locale` (`id`,`name`,`code`,`shortCode`) VALUES (1,'English','en_US','en');
INSERT INTO `Locale` (`id`,`name`,`code`,`shortCode`) VALUES (2,'Arabic','ar_IQ','ar');

INSERT INTO `user` VALUES (1,NULL,'admin@custom-cms.com','Administrator','$2y$14$8tVkJuERUMIo1mc0/2QG4.DEZxQsKMSB8vcjk1DVD7BVyzNtrmMB2');

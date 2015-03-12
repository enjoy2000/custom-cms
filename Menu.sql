-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Menu`;
CREATE TABLE `Menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('article','category','static','external') COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labelAr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valueAr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderNumber` int(11) NOT NULL,
  `parentMenu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DD3795ADB54AF4CB` (`parentMenu_id`),
  CONSTRAINT `FK_DD3795ADB54AF4CB` FOREIGN KEY (`parentMenu_id`) REFERENCES `Menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `Menu` (`id`, `type`, `label`, `labelAr`, `value`, `valueAr`, `orderNumber`, `parentMenu_id`) VALUES
(1,	'static',	'The Minister',	'الوزير',	'the-ministry',	'the-ministry',	1,	NULL),
(2,	'article',	'Opening Speech',	'كلمة افتتاحية',	'en-minister-opening-speech',	'ar-minister-opening-speech',	1,	1),
(4,	'static',	'Curriculum vitae',	'السيرة الذاتية',	'the-ministry/the-minister',	'the-ministry/the-minister',	2,	1),
(5,	'category',	'International Speeches',	'خطابات دولية',	'en-international-speeches',	'arabic-speeches-interviews',	3,	1),
(6,	'category',	'Press Conferences',	'مؤتمرات صحفية',	'press-conferences',	'ar-press-conferences',	4,	1),
(7,	'category',	'Photo Library',	'مكتبة الصور',	'photo-library',	'ar-photo-library',	5,	1),
(8,	'category',	'Video Library',	'مكتبة الفيديو',	'video-library',	'ar-video-library',	6,	1),
(9,	'static',	'The Ministry',	'الوزارة',	'the-ministry',	'the-ministry',	2,	NULL),
(10,	'category',	'Undersecretaries',	'وكلاء الوزارة',	'undersecretaries',	'ar-undersecretaries',	1,	9),
(11,	'category',	'Press Releases',	'المتحدث الرسمي',	'press-releases',	'arabic-press-releases',	2,	9),
(12,	'category',	'Ministry Departments',	'دوائر الوزارة',	'en-ministry-departments',	'ar-mofa-ministry-departments',	3,	9),
(13,	'category',	'Iraqi Ambassadors',	'سفراء العراق',	'en-iraqi-mofa-ambassadors',	'ar-iraqi-mofa-ambassadors',	4,	9),
(14,	'static',	'Mofa Ministers',	'وزراء الخارجية السابقين',	'the-ministry/mofa-ministers',	'the-ministry/mofa-ministers',	5,	9),
(15,	'category',	'Ministry\'s Magazine',	'مجلة الوزارة',	'ministry-s-magazine',	'arabic-ministry-s-magazine',	6,	9),
(16,	'article',	'The Ministry Law',	'قانون الوزارة',	'the-ministry-law-no-36-of-2013',	'ar-the-ministry-law-no-36-of-2013',	7,	9),
(17,	'article',	'Martyrs of the Ministry Of Foreign Affairs',	'شهداء الوزارة',	'en-martyrs-of-the-ministry-of-foreign-affairs',	'ar-martyrs-of-the-ministry-of-foreign-affairs',	8,	9),
(18,	'static',	'About Iraq',	'عن العراق',	'about-iraq',	'about-iraq',	3,	NULL),
(19,	'static',	'Constitution',	'الدستور',	'about-iraq/constitution',	'about-iraq/constitution',	1,	18),
(20,	'article',	'Religious Tourism',	'السياحة الدينية',	'en-religious-tourism',	'ar-mofa-religious-tourism',	2,	18),
(21,	'static',	'Tourist Guide',	'الدليل السياحي',	'about-iraq/tourist-guide',	'about-iraq/tourist-guide',	3,	18),
(22,	'static',	'The Virtual Museum of Iraq',	'زيارة المتحف العراقي',	'about-iraq/the-virtual-museum-of-iraq',	'about-iraq/the-virtual-museum-of-iraq',	4,	18),
(23,	'static',	'Encyclopedia',	'موسوعة العراق',	'about-iraq/encyclopedia',	'about-iraq/encyclopedia',	5,	18),
(24,	'static',	'Constitution Principles',	'الثوابث والمبادئ',	'about-iraq/constitution',	'about-iraq/constitution',	4,	NULL),
(25,	'article',	'Iraq and its Neighbors',	'العراق ودول الجوار',	'en-Iraq-and-its-Neighbors',	'ar-Iraq-and-its-Neighbors',	1,	24),
(26,	'static',	'Iraq and the Arab League',	'العراق والجامعة العربية',	'foreign-policy/arab-league',	'foreign-policy/arab-league',	2,	24),
(27,	'static',	'Iraq and the United Nations',	'العراق والأمم المتحدة',	'foreign-policy/iraq-and-the-united-nations',	'foreign-policy/iraq-and-the-united-nations',	3,	24),
(28,	'article',	'Iraq and the War on Terror',	'العراق والحرب على الإرهاب',	'en-Iraq-and-the-War-on-Terror',	'ar-Iraq-and-the-War-on-Terror',	4,	24),
(29,	'category',	'Official Documents',	'الوثائق الرسمية',	'en-official-documents',	'ar-mofa-official-documents',	5,	24);

-- 2015-03-12 11:09:08

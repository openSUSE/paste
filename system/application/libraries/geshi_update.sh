#!/bin/sh

echo 'DROP TABLE `languages`;'
echo 'CREATE TABLE IF NOT EXISTS `languages` (
  `code` varchar(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;'
echo 'INSERT INTO `languages` (`code`, `description`) VALUES'
for i in *.php; do echo "('"`echo $i | sed 's|\.php||'`"', `sed -n 's|.*LANG_NAME.[[:blank:]]\+=>[[:blank:]]\+\([^[:blank:]].*\),|\1|p' $i`),"; done
echo "('none', 'none');"
echo 'DELETE FROM `languages` WHERE'" code='none' AND description='none';"

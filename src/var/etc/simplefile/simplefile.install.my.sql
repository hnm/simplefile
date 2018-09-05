-- Exportiere Struktur von Tabelle mdl_simple_file.simple_file
CREATE TABLE IF NOT EXISTS `simple_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `file` varchar(255) NOT NULL,
  `linkable` tinyint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
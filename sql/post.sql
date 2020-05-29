CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `date_add` date NOT NULL,
  `post` text NOT NULL,
  PRIMARY KEY (`id_post`),
  FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`),
  FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`)
)

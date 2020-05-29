CREATE TABLE IF NOT EXISTS `vote` (
  `id_user` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `vote` boolean NOT NULL,
  FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`),
  FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`)
)


--Tokens--
--===========================================
CREATE TABLE IF NOT EXISTS `bo_tokens` (
	`id_employee`   INT NOT NULL PRIMARY KEY,
	`token`         VARCHAR(1000) NOT NULL,
	`created_date`  DATETIME NOT NULL
)
COLLATE='latin1_swedish_ci'

GO


--URLs
--============================================
CREATE TABLE IF NOT EXISTS `bo_url` (
	`id_url` INT NOT NULL PRIMARY KEY,
	`url` VARCHAR(50) NOT NULL
)
COLLATE='latin1_swedish_ci'
;


--Employee Accesses
--============================================
GO


CREATE TABLE IF NOT EXISTS `bo_url` (
  `id_url` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `text` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id_url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
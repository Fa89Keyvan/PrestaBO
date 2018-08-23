
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
  `id_url` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `text` varchar(50) CHARACTER SET utf8 NOT NULL,
  `menu` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `api` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
;


--Employee Accesses
--============================================
GO

CREATE TABLE IF NOT EXISTS `bo_employee_access` (
  `id_employee_access` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_access`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

GO


--bo_hf_contacts
--=============================================
CREATE TABLE IF NOT EXISTS bo_hf_contacts(id_customer int not null,hf_code int not null);
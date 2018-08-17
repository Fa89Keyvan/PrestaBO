CREATE TABLE IF NOT EXISTS `bo_tokens` (
	`id_employee`   INT NOT NULL PRIMARY KEY,
	`token`         VARCHAR(1000) NOT NULL,
	`created_date`  DATETIME NOT NULL
)
COLLATE='latin1_swedish_ci'
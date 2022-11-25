CREATE TABLE account_holders (
 id int(11) unsigned NOT NULL AUTO_INCREMENT,
 name varchar(65) NOT NULL,
 passwords varchar(250) NOT NULL,
 email varchar(100) NOT NULL,
 bio  varchar(600) NOT NULL,
 PRIMARY KEY (id),
 UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
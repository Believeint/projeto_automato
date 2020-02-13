CREATE TABLE `Transacao`
(
	`transacao_id` VARCHAR
(36) NOT NULL,
	`cliente_nome` VARCHAR
(60),
	`cliente_email` VARCHAR
(60),
	`debito_credito` VARCHAR
(20) NOT NULL,
	`tipo_transacao` VARCHAR
(20) NOT NULL,
	`status` VARCHAR
(20) NOT NULL,
	`tipo_pagamento` VARCHAR
(30) NOT NULL,
	`valor_bruto` DECIMAL
(8,2) NOT NULL,
	`valor_desconto` DECIMAL
(8,2) NOT NULL,
	`valor_taxa` DECIMAL
(8,2) NOT NULL,
	`valor_liquido` DECIMAL
(8,2) NOT NULL,
	`transportadora` VARCHAR
(60),
	`num_envio` VARCHAR
(60),
	`data_transacao` DATETIME NOT NULL,
	`data_compensacao` DATETIME NOT NULL,
	`ref_transacao` VARCHAR
(60),
	`parcelas` INT
(2) NOT NULL,
	`codigo_usuario` VARCHAR
(20) NOT NULL,
	`codigo_venda` VARCHAR
(20) NOT NULL,
	`serial_leitor` VARCHAR
(20) NOT NULL,
	`recebimentos` INT
(3) NOT NULL,
	`recebidos` INT
(3) NOT NULL,
	`valor_recebido` DECIMAL
(8,2) NOT NULL,
	`valor_tarifa_intermediacao` DECIMAL
(8,2) NOT NULL,
	`valor_taxa_intermediacao` DECIMAL
(8,2) NOT NULL,
	`valor_taxa_parcelamento` DECIMAL
(8,2) NOT NULL,
	`valor_tarifa_boleto` DECIMAL
(8,2) NOT NULL,
	`bandeira_cartao_credito` VARCHAR
(30) NOT NULL,
	PRIMARY KEY
(`transacao_id`)
);

CREATE TABLE `Cliente`
(
	`id` INT
(10) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR
(60),
	`serial_leitor` VARCHAR
(36) NOT NULL UNIQUE,
	`email` VARCHAR
(36),
	`contato` VARCHAR
(36),
	`id_taxa` INT
(10) NOT NULL,
	`id_iss` INT
(10) NOT NULL,
	PRIMARY KEY
(`id`)
);

CREATE TABLE `Arquivo`
(
	`id` INT
(10) NOT NULL AUTO_INCREMENT,
	`data_envio` DATETIME NOT NULL,
	PRIMARY KEY
(`id`)
);

CREATE TABLE `Taxa`
(
	`id` INT
(10) NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR
(30),
	`valor` DECIMAL
(3,2),
	PRIMARY KEY
(`id`)
);

CREATE TABLE `ISS`
(
	`id` INT
(10) NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR
(30),
	`valor` DECIMAL
(3,2),
	PRIMARY KEY
(`id`)
);

CREATE TABLE `Arquivo_Transacao`
(
	`id_arquivo` INT NOT NULL,
	`id_transacao` VARCHAR
(36) NOT NULL,
	PRIMARY KEY
(`id_arquivo`,`id_transacao`)
);

ALTER TABLE `Cliente`
ADD CONSTRAINT `Cliente_fk0` FOREIGN KEY
(`id_taxa`) REFERENCES `Taxa`
(`id`);

ALTER TABLE `Cliente`
ADD CONSTRAINT `Cliente_fk1` FOREIGN KEY
(`id_iss`) REFERENCES `ISS`
(`id`);

ALTER TABLE `Arquivo_Transacao`
ADD CONSTRAINT `Arquivo_Transacao_fk0` FOREIGN KEY
(`id_arquivo`) REFERENCES `Arquivo`
(`id`);

ALTER TABLE `Arquivo_Transacao`
ADD CONSTRAINT `Arquivo_Transacao_fk1` FOREIGN KEY
(`id_transacao`) REFERENCES `Transacao`
(`transacao_id`);

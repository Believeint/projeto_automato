CREATE TABLE `Transacao` (
	`transacao_id` VARCHAR(36) NOT NULL,
	`cliente_nome` VARCHAR(60),
	`cliente_email` VARCHAR(60),
	`debito_credito` VARCHAR(20) NOT NULL,
	`tipo_transacao` VARCHAR(20) NOT NULL,
	`status` VARCHAR(20) NOT NULL,
	`tipo_pagamento` VARCHAR(30) NOT NULL,
	`valor_bruto` DECIMAL NOT NULL,
	`valor_desconto` DECIMAL NOT NULL,
	`valor_taxa` DECIMAL NOT NULL,
	`valor_liquido` DECIMAL NOT NULL,
	`transportadora` VARCHAR(60),
	`num_envio` VARCHAR(60),
	`data_transacao` DATETIME NOT NULL,
	`data_compensacao` DATETIME NOT NULL,
	`ref_transacao` VARCHAR(60),
	`parcelas` INT(2) NOT NULL,
	`codigo_usuario` VARCHAR(20) NOT NULL,
	`codigo_venda` VARCHAR(20) NOT NULL,
	`serial_leitor` VARCHAR(20),
	`recebimentos` INT(3) NOT NULL,
	`recebidos` INT(3) NOT NULL,
	`valor_recebido` DECIMAL NOT NULL,
	`valor_tarifa_intermediacao` DECIMAL NOT NULL,
	`valor_taxa_intermediacao` DECIMAL NOT NULL,
	`valor_taxa_parcelamento` DECIMAL NOT NULL,
	`valor_tarifa_boleto` DECIMAL NOT NULL,
	`bandeira_cartao_credito` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`transacao_id`)
);

CREATE TABLE `Cliente` (
	`id` VARCHAR(20) NOT NULL,
	`nome` VARCHAR(60),
	`email` VARCHAR(36),
	`contato` VARCHAR(36),
	`id_taxa` INT(10) NOT NULL,
	`id_iss` INT(10) NOT NULL,
	`serial_leitor` VARCHAR(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Arquivo` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`data_envio` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Taxa` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR(30),
	`valor` DECIMAL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `ISS` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR(30),
	`valor` DECIMAL(30),
	PRIMARY KEY (`id`)
);

CREATE TABLE `arquivo_transacao` (
	`arquivo_id` INT NOT NULL,
	`transacao_id` varchar(36) NOT NULL,
	PRIMARY KEY (`arquivo_id`,`transacao_id`)
);

ALTER TABLE `Cliente` ADD CONSTRAINT `Cliente_fk0` FOREIGN KEY (`id_taxa`) REFERENCES `Taxa`(`id`);

ALTER TABLE `Cliente` ADD CONSTRAINT `Cliente_fk1` FOREIGN KEY (`id_iss`) REFERENCES `ISS`(`id`);

ALTER TABLE `arquivo_transacao` ADD CONSTRAINT `arquivo_transacao_fk0` FOREIGN KEY (`arquivo_id`) REFERENCES `Arquivo`(`id`);

ALTER TABLE `arquivo_transacao` ADD CONSTRAINT `arquivo_transacao_fk1` FOREIGN KEY (`transacao_id`) REFERENCES `Transacao`(`transacao_id`);

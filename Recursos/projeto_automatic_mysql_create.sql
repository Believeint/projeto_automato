DROP TABLE IF EXISTS id12677329_automatic.Arquivo_Relatorio;
DROP TABLE IF EXISTS id12677329_automatic.Arquivo_Transacao;
DROP TABLE IF EXISTS id12677329_automatic.Arquivo;
DROP TABLE IF EXISTS id12677329_automatic.Transacao;
DROP TABLE IF EXISTS id12677329_automatic.Cliente;



CREATE TABLE `id12677329_automatic.Transacao` (
	`transacao_id` VARCHAR(36) NOT NULL,
	`cliente_nome` VARCHAR(60),
	`cliente_email` VARCHAR(60),
	`debito_credito` VARCHAR(20) NOT NULL,
	`tipo_transacao` VARCHAR(20) NOT NULL,
	`status` VARCHAR(20) NOT NULL,
	`tipo_pagamento` VARCHAR(30) NOT NULL,
	`valor_bruto` DECIMAL(8,2) NOT NULL,
	`valor_desconto` DECIMAL(8,2) NOT NULL,
	`valor_taxa` DECIMAL(8,2) NOT NULL,
	`valor_liquido` DECIMAL(8,2) NOT NULL,
	`transportadora` VARCHAR(60),
	`num_envio` VARCHAR(60),
	`data_transacao` varchar(30) NOT NULL,
	`data_compensacao` varchar(30) NOT NULL,
	`ref_transacao` VARCHAR(60),
	`parcelas` INT(2) NOT NULL,
	`codigo_usuario` VARCHAR(20) NOT NULL,
	`codigo_venda` VARCHAR(20) NOT NULL,
	`serial_leitor` VARCHAR(20) NOT NULL,
	`recebimentos` INT(3) NOT NULL,
	`recebidos` INT(3) NOT NULL,
	`valor_recebido` DECIMAL(8,2) NOT NULL,
	`valor_tarifa_intermediacao` DECIMAL(8,2) NOT NULL,
	`valor_taxa_intermediacao` DECIMAL(8,2) NOT NULL,
	`valor_taxa_parcelamento` DECIMAL(8,2) NOT NULL,
	`valor_tarifa_boleto` DECIMAL(8,2) NOT NULL,
	`bandeira_cartao_credito` VARCHAR(30) NOT NULL,
	`id_cliente` INT(10),
	PRIMARY KEY (`transacao_id`)
);

CREATE TABLE `id12677329_automatic.Cliente` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(60),
	`serial_leitor` VARCHAR(20) NOT NULL UNIQUE,
	`email` VARCHAR(36),
	`contato` VARCHAR(36),
	`taxa_deb` DECIMAL(5,2) NOT NULL,
	`taxa_cred_1x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_2x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_3x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_4x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_5x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_6x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_7x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_8x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_9x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_10x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_11x` DECIMAL(5,2) NOT NULL,
	`taxa_cred_12x` DECIMAL(5,2) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `id12677329_automatic.Arquivo` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`data_envio` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `id12677329_automatic.Arquivo_Transacao` (
	`id_arquivo` INT NOT NULL,
	`id_transacao` varchar(36) NOT NULL,
	PRIMARY KEY (`id_arquivo`,`id_transacao`)
);

CREATE TABLE `id12677329_automatic.Arquivo_Relatorio` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`id_arquivo` INT(10) DEFAULT '0',
	`id_cliente` INT(10) NOT NULL,
	`liquido_cliente` DECIMAL(8,2) NOT NULL,
	`lucro` DECIMAL(8,2) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `id12677329_automatic.Transacao` ADD CONSTRAINT `Transacao_fk0` FOREIGN KEY (`id_cliente`) REFERENCES `id12677329_automatic.Cliente`(`id`);

ALTER TABLE `id12677329_automatic.Arquivo_Transacao` ADD CONSTRAINT `Arquivo_Transacao_fk0` FOREIGN KEY (`id_arquivo`) REFERENCES `id12677329_automatic.Arquivo`(`id`);

ALTER TABLE `id12677329_automatic.Arquivo_Transacao` ADD CONSTRAINT `Arquivo_Transacao_fk1` FOREIGN KEY (`id_transacao`) REFERENCES `id12677329_automatic.Transacao`(`transacao_id`);

ALTER TABLE `id12677329_automatic.Arquivo_Relatorio` ADD CONSTRAINT `Arquivo_Relatorio_fk0` FOREIGN KEY (`id_arquivo`) REFERENCES `id12677329_automatic.Arquivo`(`id`);

ALTER TABLE `id12677329_automatic.Arquivo_Relatorio` ADD CONSTRAINT `Arquivo_Relatorio_fk1` FOREIGN KEY (`id_cliente`) REFERENCES `id12677329_automatic.Cliente`(`id`);

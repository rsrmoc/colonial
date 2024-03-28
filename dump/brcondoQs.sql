/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 80027
Source Host           : localhost:3306
Source Database       : brcondos

Target Server Type    : MYSQL
Target Server Version : 80027
File Encoding         : 65001

Date: 2023-06-03 09:08:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for boletos
-- ----------------------------
DROP TABLE IF EXISTS `boletos`;
CREATE TABLE `boletos` (
  `cd_boleto` int NOT NULL AUTO_INCREMENT,
  `id_boleto` int NOT NULL,
  `cd_condominio` int NOT NULL,
  `nr_documento` varchar(50) DEFAULT NULL,
  `bloco_apto` varchar(100) DEFAULT NULL,
  `bloco` varchar(50) DEFAULT NULL,
  `apto` varchar(50) DEFAULT NULL,
  `nosso_numero` varchar(50) DEFAULT NULL,
  `nm_cliente` varchar(255) NOT NULL,
  `cpf_puro` varchar(50) DEFAULT NULL,
  `cpf_cnpj` varchar(50) NOT NULL,
  `grupo_historico` varchar(100) DEFAULT NULL,
  `fone` varchar(100) DEFAULT NULL,
  `id_unidade` varchar(20) DEFAULT NULL,
  `dt_vencimento` date DEFAULT NULL,
  `dt_registro` date DEFAULT NULL,
  `dt_emissao` date DEFAULT NULL,
  `dt_pago` date DEFAULT NULL,
  `dt_expiracao` date DEFAULT NULL,
  `vl_boleto` decimal(10,2) DEFAULT NULL,
  `vl_pago` decimal(10,2) DEFAULT NULL,
  `vl_desconto` decimal(10,2) DEFAULT NULL,
  `vl_juros` decimal(10,2) DEFAULT NULL,
  `vl_multa` decimal(10,2) DEFAULT NULL,
  `vl_total` decimal(10,2) DEFAULT NULL,
  `detalhes` longtext,
  `key` varchar(50) DEFAULT NULL,
  `ds_conta` varchar(100) DEFAULT NULL,
  `tipo_conta` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tp_status` varchar(50) DEFAULT NULL,
  `sn_atrasado` varchar(10) DEFAULT NULL,
  `forma_pag` varchar(50) DEFAULT NULL,
  `centro_custo` varchar(100) DEFAULT NULL,
  `impresso_boleto` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_boleto`),
  KEY `Fw` (`cd_condominio`),
  CONSTRAINT `Fw` FOREIGN KEY (`cd_condominio`) REFERENCES `condominios` (`cd_condominio`)
) ENGINE=InnoDB AUTO_INCREMENT=10192 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for boletos_historico
-- ----------------------------
DROP TABLE IF EXISTS `boletos_historico`;
CREATE TABLE `boletos_historico` (
  `cd_boleto_hist` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_boleto_hist`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for bot
-- ----------------------------
DROP TABLE IF EXISTS `bot`;
CREATE TABLE `bot` (
  `cd_bot` varchar(2) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_bot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for bot_2
-- ----------------------------
DROP TABLE IF EXISTS `bot_2`;
CREATE TABLE `bot_2` (
  `cd_bot` varchar(2) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_bot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for cadastro
-- ----------------------------
DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE `cadastro` (
  `cd_cadastro` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome_paciente` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_convenio` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_convenio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_medico` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cd_hospital` bigint unsigned NOT NULL,
  `data_cirurgia` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_cadastro`),
  KEY `cadastro_cd_hospital_foreign` (`cd_hospital`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for cadastro_produtos
-- ----------------------------
DROP TABLE IF EXISTS `cadastro_produtos`;
CREATE TABLE `cadastro_produtos` (
  `cd_cad_produto` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cd_cadastro` bigint unsigned NOT NULL,
  `cd_produto` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_cad_produto`),
  KEY `cadastro_produtos_cd_cadastro_foreign` (`cd_cadastro`),
  KEY `cadastro_produtos_cd_produto_foreign` (`cd_produto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for condominios
-- ----------------------------
DROP TABLE IF EXISTS `condominios`;
CREATE TABLE `condominios` (
  `chave` int NOT NULL AUTO_INCREMENT,
  `cd_condominio` int DEFAULT NULL,
  `nm_condominio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `br_condos` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sn_ativo` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'S',
  `id_usuario` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`chave`),
  UNIQUE KEY `FwCdCond` (`cd_condominio`),
  KEY `FwUserCond` (`id_usuario`),
  CONSTRAINT `FwUserCond` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for faturamento
-- ----------------------------
DROP TABLE IF EXISTS `faturamento`;
CREATE TABLE `faturamento` (
  `cd_faturamento` int NOT NULL AUTO_INCREMENT,
  `id` int DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `dt_realizacao` datetime DEFAULT NULL,
  `nr_autorizacao` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `solic` varchar(50) DEFAULT NULL,
  `carteira` varchar(100) DEFAULT NULL,
  `nm_carteira` varchar(255) DEFAULT NULL,
  `cod_pro` varchar(50) DEFAULT NULL,
  `nm_pro` varchar(512) DEFAULT NULL,
  `status_pro` varchar(50) DEFAULT NULL,
  `qtde` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_faturamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for historico_cliente
-- ----------------------------
DROP TABLE IF EXISTS `historico_cliente`;
CREATE TABLE `historico_cliente` (
  `cd_historico` int NOT NULL AUTO_INCREMENT,
  `cpf_cnpj_cliente` varchar(100) NOT NULL,
  `historico` text,
  `id_usuario` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cd_historico`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for hospital
-- ----------------------------
DROP TABLE IF EXISTS `hospital`;
CREATE TABLE `hospital` (
  `cd_hospital` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nm_hospital` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_hospital`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for negociacoes
-- ----------------------------
DROP TABLE IF EXISTS `negociacoes`;
CREATE TABLE `negociacoes` (
  `cd_negociacao` int NOT NULL AUTO_INCREMENT,
  `dt_negociacao` date NOT NULL,
  `nr_contato` varchar(50) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `id_usuario` bigint unsigned NOT NULL,
  `cpf_cnpj_cliente` varchar(50) NOT NULL,
  `nm_cliente` varchar(100) NOT NULL,
  `cd_condominio` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_negociacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for negociacoes_boleto
-- ----------------------------
DROP TABLE IF EXISTS `negociacoes_boleto`;
CREATE TABLE `negociacoes_boleto` (
  `cd_negociacao_boleto` int NOT NULL AUTO_INCREMENT,
  `cd_negociacao` int NOT NULL,
  `cd_boleto` int NOT NULL,
  `id_usuario` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cd_negociacao_boleto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for perfis
-- ----------------------------
DROP TABLE IF EXISTS `perfis`;
CREATE TABLE `perfis` (
  `cd_perfil` int NOT NULL AUTO_INCREMENT,
  `nm_perfil` varchar(255) DEFAULT NULL,
  `sn_ativo` varchar(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cd_perfil`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id_permissions` int NOT NULL AUTO_INCREMENT,
  `cd_permissao` varchar(255) DEFAULT NULL,
  `opcao` set('ver','criar','excluir','detalhes') DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_permissions`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for produto
-- ----------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `cd_produto` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nm_produto` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_produto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tabelas
-- ----------------------------
DROP TABLE IF EXISTS `tabelas`;
CREATE TABLE `tabelas` (
  `cd_tabela` int NOT NULL AUTO_INCREMENT,
  `campo` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `sn_ativo` varchar(1) DEFAULT NULL,
  `tp_tabela` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cd_tabela`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_perfil` int DEFAULT NULL,
  `fone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` bigint unsigned NOT NULL,
  `nome` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissoes` set('ver','criar','excluir','detalhes') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_permissions_user_foreign` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

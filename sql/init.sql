# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: heh-it.com (MySQL 5.5.31-log)
# Database: picocms
# Generation Time: 2013-06-22 09:08:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ci_attachments
# ------------------------------------------------------------

CREATE TABLE `ci_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userfile` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `scope_id` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT '1',
  `related_to` varchar(200) DEFAULT NULL,
  `related_to_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_base_settings
# ------------------------------------------------------------

CREATE TABLE `ci_base_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(200) DEFAULT NULL,
  `licence_code` varchar(200) DEFAULT NULL,
  `licence_expire` varchar(100) DEFAULT NULL,
  `order_request_code` varchar(100) DEFAULT NULL,
  `quotation_code` varchar(100) DEFAULT NULL,
  `project_code` varchar(100) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT NULL,
  `default_language` varchar(100) DEFAULT NULL,
  `invoice_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_contacts
# ------------------------------------------------------------

CREATE TABLE `ci_contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `second` varchar(250) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `phone_alt` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_ddt
# ------------------------------------------------------------

CREATE TABLE `ci_ddt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `number` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `userfile` varchar(200) DEFAULT NULL,
  `description` text,
  `creation_date` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_directions
# ------------------------------------------------------------

CREATE TABLE `ci_directions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_groups
# ------------------------------------------------------------

CREATE TABLE `ci_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `avatar` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_informations_kinds
# ------------------------------------------------------------

CREATE TABLE `ci_informations_kinds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_informations_status
# ------------------------------------------------------------

CREATE TABLE `ci_informations_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_invoice_lines
# ------------------------------------------------------------

CREATE TABLE `ci_invoice_lines` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `price_external` float DEFAULT NULL,
  `printable` int(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `taxes` float DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_invoice_payments
# ------------------------------------------------------------

CREATE TABLE `ci_invoice_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_invoice_terms
# ------------------------------------------------------------

CREATE TABLE `ci_invoice_terms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `amount` float DEFAULT NULL,
  `due` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `creation_date` int(100) DEFAULT NULL,
  `update_date` int(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_invoices
# ------------------------------------------------------------

CREATE TABLE `ci_invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(200) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `description` text,
  `project_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT '?',
  `direction` varchar(100) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `amount_untaxed` float DEFAULT NULL,
  `residual` float DEFAULT NULL,
  `date_due` varchar(100) DEFAULT NULL,
  `sal_id` int(11) DEFAULT NULL,
  `transfer` float DEFAULT '0',
  `transfer_descr` varchar(200) DEFAULT '-',
  `taxes` float DEFAULT '21',
  `payment_method_id` int(11) DEFAULT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `invoice_date` varchar(100) DEFAULT NULL,
  `customer_order` varchar(200) DEFAULT NULL,
  `period` varchar(200) DEFAULT NULL,
  `progress_percentage` float DEFAULT NULL,
  `progress_step` float DEFAULT NULL,
  `amount_letteral` varchar(200) DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  `taxes_notes` varchar(200) DEFAULT NULL,
  `literal_price` varchar(250) DEFAULT '',
  `show_progress` varchar(100) DEFAULT '0',
  `notes` text,
  `notes_printable` text,
  `transport_notes` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_languages
# ------------------------------------------------------------

CREATE TABLE `ci_languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_log
# ------------------------------------------------------------

CREATE TABLE `ci_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(80) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `event` varchar(250) DEFAULT NULL,
  `ipaddr` varchar(250) DEFAULT NULL,
  `uagent` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_modules
# ------------------------------------------------------------

CREATE TABLE `ci_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `author` varchar(250) DEFAULT NULL,
  `author_email` varchar(250) DEFAULT NULL,
  `controller_name` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `icon` blob,
  `ordering` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_news
# ------------------------------------------------------------

CREATE TABLE `ci_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `body` text,
  `type` varchar(100) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `author_id` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_partner_addresses
# ------------------------------------------------------------

CREATE TABLE `ci_partner_addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `province` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `address_kind` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_partner_category
# ------------------------------------------------------------

CREATE TABLE `ci_partner_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;



# Dump of table ci_partners
# ------------------------------------------------------------

CREATE TABLE `ci_partners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `vat` varchar(200) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `cf` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_payment_methods
# ------------------------------------------------------------

CREATE TABLE `ci_payment_methods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `payments_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_products
# ------------------------------------------------------------

CREATE TABLE `ci_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `brand` varchar(250) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_project_activities
# ------------------------------------------------------------

CREATE TABLE `ci_project_activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_project_items
# ------------------------------------------------------------

CREATE TABLE `ci_project_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `pos` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `delivery_time` varchar(100) DEFAULT NULL,
  `order_date` varchar(100) DEFAULT NULL,
  `closing_date` varchar(100) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `price_budget` float DEFAULT NULL,
  `price_sold` float DEFAULT NULL,
  `bill` blob,
  `notes` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `milestone` int(11) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `currency` varchar(100) DEFAULT '?',
  `code` varchar(100) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT '6',
  `wf_step` varchar(100) DEFAULT 'new',
  `label` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_project_milestones
# ------------------------------------------------------------

CREATE TABLE `ci_project_milestones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `extimated_date` varchar(100) DEFAULT NULL,
  `real_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_projects
# ------------------------------------------------------------

CREATE TABLE `ci_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(200) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `projectmanager_id` int(11) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `estimated_close_date` varchar(100) DEFAULT NULL,
  `real_close_date` varchar(100) DEFAULT NULL,
  `userfile` varchar(200) DEFAULT 'project_placeholder.png',
  `sal` float DEFAULT '0',
  `ordine_cliente` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `order_amount` double DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `customer_order` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_projects_deleted
# ------------------------------------------------------------

CREATE TABLE `ci_projects_deleted` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(200) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `projectmanager_id` int(11) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `estimated_close_date` varchar(100) DEFAULT NULL,
  `real_close_date` varchar(100) DEFAULT NULL,
  `userfile` varchar(200) DEFAULT 'project_placeholder.png',
  `sal` float DEFAULT '0',
  `ordine_cliente` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `order_amount` float DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `customer_order` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_purchase_request
# ------------------------------------------------------------

CREATE TABLE `ci_purchase_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `notes` text,
  `project_id` int(11) DEFAULT NULL,
  `userfile` varchar(100) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  `description` text,
  `deviation` text,
  `supplier_id` int(11) DEFAULT NULL,
  `price_budget` float DEFAULT NULL,
  `price_extimated` float DEFAULT NULL,
  `quotation_ref` varchar(200) DEFAULT NULL,
  `delivery_request` varchar(200) DEFAULT NULL,
  `shipping_address` text,
  `number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_purchase_request_rows
# ------------------------------------------------------------

CREATE TABLE `ci_purchase_request_rows` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` int(11) DEFAULT NULL,
  `project_item_id` int(11) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_purchase_rows
# ------------------------------------------------------------

CREATE TABLE `ci_purchase_rows` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `project_item_id` int(11) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `uom` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_purchase_rows_copy
# ------------------------------------------------------------

CREATE TABLE `ci_purchase_rows_copy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `project_item_id` int(11) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_purchases
# ------------------------------------------------------------

CREATE TABLE `ci_purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `creation_uid` varchar(100) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(100) DEFAULT NULL,
  `delivery_address` text,
  `arrival_date` varchar(100) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `notes` text,
  `supplier_id` int(11) DEFAULT NULL,
  `price_budget` float DEFAULT NULL,
  `extimated_cost` float DEFAULT NULL,
  `quotation_ref` varchar(200) DEFAULT NULL,
  `price_final` float DEFAULT NULL,
  `order_date` varchar(100) DEFAULT NULL,
  `ref` varchar(240) DEFAULT NULL,
  `payment` varchar(250) DEFAULT NULL,
  `attention_of` varchar(250) DEFAULT NULL,
  `delivery_terms` varchar(250) DEFAULT NULL,
  `delivery_time` varchar(250) DEFAULT NULL,
  `warranty_terms` varchar(250) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_quotation_rows
# ------------------------------------------------------------

CREATE TABLE `ci_quotation_rows` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `price_internal` float DEFAULT NULL,
  `price_external` float DEFAULT NULL,
  `price_closed` float DEFAULT NULL,
  `price_budget` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `margin` float DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `description` text,
  `creation_date` varchar(100) DEFAULT NULL,
  `printable` int(1) DEFAULT '1',
  `visible` int(1) DEFAULT '1',
  `quotation_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '1',
  `unit` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `taxes` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT '?',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_quotationreq
# ------------------------------------------------------------

CREATE TABLE `ci_quotationreq` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `notes` text,
  `subject` varchar(250) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `userfile` varchar(200) DEFAULT NULL,
  `userfile_size` varchar(200) DEFAULT NULL,
  `userfile_type` varchar(200) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT NULL,
  `wf_step` varchar(200) DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_quotations
# ------------------------------------------------------------

CREATE TABLE `ci_quotations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `wf_flow` int(11) DEFAULT '1',
  `wf_step` varchar(100) DEFAULT 'draft',
  `description` text,
  `preview` blob,
  `currency` varchar(100) DEFAULT '?',
  `transport` varchar(250) DEFAULT NULL,
  `delivery_terms` varchar(250) DEFAULT NULL,
  `reference` varchar(250) DEFAULT NULL,
  `delivery_time` varchar(250) DEFAULT NULL,
  `payment_terms` varchar(250) DEFAULT NULL,
  `valid_until` varchar(250) DEFAULT NULL,
  `attn` varchar(200) DEFAULT NULL,
  `destination` text,
  `send_date` varchar(100) DEFAULT NULL,
  `notes` text,
  `exclusions` text,
  `type` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_req_quotation
# ------------------------------------------------------------

CREATE TABLE `ci_req_quotation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_rights
# ------------------------------------------------------------

CREATE TABLE `ci_rights` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(250) DEFAULT NULL,
  `action` varchar(250) DEFAULT NULL,
  `rule` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `gid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_scopes
# ------------------------------------------------------------

CREATE TABLE `ci_scopes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_users
# ------------------------------------------------------------

CREATE TABLE `ci_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `second_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `creation_date` varchar(250) DEFAULT NULL,
  `update_date` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `notes` text,
  `avatar` blob,
  `language` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_users_groups
# ------------------------------------------------------------

CREATE TABLE `ci_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;



# Dump of table ci_warehouse
# ------------------------------------------------------------

CREATE TABLE `ci_warehouse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `creation_date` varchar(100) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `arrival_date` varchar(100) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `exit_date` varchar(100) DEFAULT NULL,
  `delivered_to` varchar(250) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL COMMENT 'on_warehouse,delivered',
  `notes` text,
  `tobe_reintegrated` int(11) DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table ci_workflows
# ------------------------------------------------------------

CREATE TABLE `ci_workflows` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `update_date` varchar(100) DEFAULT NULL,
  `revision` varchar(100) DEFAULT NULL,
  `related_to` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_workflows_actions
# ------------------------------------------------------------

CREATE TABLE `ci_workflows_actions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `controller` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `creation_date` varchar(200) DEFAULT NULL,
  `update_date` varchar(200) DEFAULT NULL,
  `creation_uid` int(11) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Dump of table ci_workflows_steps
# ------------------------------------------------------------

CREATE TABLE `ci_workflows_steps` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `wf_id` int(11) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `uid` varchar(200) DEFAULT NULL,
  `gid` varchar(200) DEFAULT NULL,
  `enter_action` int(11) DEFAULT NULL,
  `exit_action` int(11) DEFAULT NULL,
  `skip` tinyint(1) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

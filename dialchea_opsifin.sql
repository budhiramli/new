-- phpMyAdmin SQL Dump
-- version 4.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 10:15 PM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dialchea_opsifin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE IF NOT EXISTS `bank_account` (
  `bank_account_id` int(11) NOT NULL,
  `bank_account_name` varchar(50) DEFAULT NULL,
  `bank_account_type_id` int(11) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `bank_account_is_default` set('TRUE','FALSE') DEFAULT 'FALSE',
  `account_code` varchar(15) DEFAULT NULL,
  `bank_account_bank_name` varchar(50) DEFAULT NULL,
  `bank_account_bank_number` varchar(50) DEFAULT NULL,
  `bank_account_bank_address` tinytext
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='bank account';

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`bank_account_id`, `bank_account_name`, `bank_account_type_id`, `currency`, `bank_account_is_default`, `account_code`, `bank_account_bank_name`, `bank_account_bank_number`, `bank_account_bank_address`) VALUES
(1, 'BANK BCA', 2, ' AUD ', 'TRUE', ' 22222 ', 'BANK CENTRAL ASIA', '111111', 'jakarta'),
(2, 'BANK BCA', 2, ' AUD ', 'FALSE', ' 22222 ', 'BANK CENTRAL ASIA', '111111', 'jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_type`
--

CREATE TABLE IF NOT EXISTS `bank_account_type` (
  `bank_account_type_id` int(11) NOT NULL,
  `bank_account_type_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='bank account type';

--
-- Dumping data for table `bank_account_type`
--

INSERT INTO `bank_account_type` (`bank_account_type_id`, `bank_account_type_name`) VALUES
(1, 'Saving Account'),
(2, 'Cash Account');

-- --------------------------------------------------------

--
-- Table structure for table `billing_transaction`
--

CREATE TABLE IF NOT EXISTS `billing_transaction` (
  `bill_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date NOT NULL,
  `company_code` varchar(15) NOT NULL,
  `branch_code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_transaction`
--

INSERT INTO `billing_transaction` (`bill_no`, `transaction_date`, `due_date`, `company_code`, `branch_code`) VALUES
('00002', '1970-01-01', '1970-01-01', '', ''),
('00003', '1970-01-01', '1970-01-01', '', ''),
('00004', '1970-01-01', '1970-01-01', '00012', '00014');

-- --------------------------------------------------------

--
-- Table structure for table `billing_transaction_detail`
--

CREATE TABLE IF NOT EXISTS `billing_transaction_detail` (
  `bill_detail_id` int(11) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `invoice_no` varchar(15) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `amount` double NOT NULL,
  `is_paid` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_transaction_detail`
--

INSERT INTO `billing_transaction_detail` (`bill_detail_id`, `bill_no`, `invoice_no`, `currency`, `amount`, `is_paid`) VALUES
(1, '1', '', '1', 1, 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `cc_transaction`
--

CREATE TABLE IF NOT EXISTS `cc_transaction` (
  `cc_no` varchar(30) NOT NULL,
  `transaction_date` date NOT NULL,
  `branch_code` varchar(15) NOT NULL,
  `transaction_code` date NOT NULL,
  `company_code` varchar(15) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `amount` double NOT NULL,
  `charges_currency` varchar(5) NOT NULL,
  `charges_amount` double NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_transaction`
--

CREATE TABLE IF NOT EXISTS `cheque_transaction` (
  `cheque_no` varchar(20) CHARACTER SET latin1 NOT NULL,
  `branch_code` varchar(20) CHARACTER SET latin1 NOT NULL,
  `bg_prefix` varchar(30) CHARACTER SET latin1 NOT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date NOT NULL,
  `ref_prefix` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ref_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cp` varchar(100) CHARACTER SET latin1 NOT NULL,
  `bank_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `currency` varchar(10) CHARACTER SET latin1 NOT NULL,
  `amount` double NOT NULL,
  `note` text CHARACTER SET latin1 NOT NULL,
  `used_amount` double NOT NULL,
  `clearing_in` int(11) NOT NULL,
  `clearing_out` int(11) NOT NULL,
  `is_balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cn_transaction`
--

CREATE TABLE IF NOT EXISTS `cn_transaction` (
  `cn_no` varchar(15) NOT NULL,
  `transaction_no` varchar(30) NOT NULL,
  `branch_code` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `company_code` varchar(15) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `used_amount` double NOT NULL,
  `is_add_manual` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cn_transaction`
--

INSERT INTO `cn_transaction` (`cn_no`, `transaction_no`, `branch_code`, `transaction_date`, `transaction_type_id`, `dept_id`, `company_code`, `cp`, `used_amount`, `is_add_manual`) VALUES
('00007', '00007', 'COMP00010', '1970-01-01', 0, 0, 'COMP00011', '', 0, 'FALSE'),
('00010', '00010', '', '1970-01-01', 0, 0, '', '', 0, 'FALSE'),
('00011', '00011', '', '1970-01-01', 0, 0, '', '', 0, 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `coa_account`
--

CREATE TABLE IF NOT EXISTS `coa_account` (
  `account_code` varchar(15) NOT NULL,
  `owner_code` varchar(10) NOT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `coa_group_id` int(11) DEFAULT NULL,
  `account_desc` varchar(200) DEFAULT NULL,
  `account_is_active` set('TRUE','FALSE') DEFAULT 'TRUE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='table coa account';

--
-- Dumping data for table `coa_account`
--

INSERT INTO `coa_account` (`account_code`, `owner_code`, `account_name`, `coa_group_id`, `account_desc`, `account_is_active`) VALUES
('1111', '', 'TEST', 12, NULL, 'TRUE'),
('22222', '', 'ABIS SAJA', 4, NULL, 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `coa_class`
--

CREATE TABLE IF NOT EXISTS `coa_class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(45) DEFAULT NULL,
  `class_type_id` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1112 DEFAULT CHARSET=latin1 COMMENT='coa class';

--
-- Dumping data for table `coa_class`
--

INSERT INTO `coa_class` (`class_id`, `class_name`, `class_type_id`) VALUES
(1, 'Aktiva', 1),
(2, 'Kewajiban dan Modal', 2),
(3, 'Pendapatan', 3),
(4, 'Biaya', 4),
(1111, 'test 2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `coa_class_group`
--

CREATE TABLE IF NOT EXISTS `coa_class_group` (
  `coa_group_id` varchar(15) NOT NULL,
  `coa_group_name` varchar(50) NOT NULL,
  `coa_parent_id` varchar(15) NOT NULL,
  `class_id` int(11) NOT NULL,
  `coa_group_is_active` set('TRUE','FALSE') NOT NULL DEFAULT 'TRUE'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_class_group`
--

INSERT INTO `coa_class_group` (`coa_group_id`, `coa_group_name`, `coa_parent_id`, `class_id`, `coa_group_is_active`) VALUES
('1', 'Aktiva Lancar', '0', 1, 'TRUE'),
('2', 'Inventory', '0', 1, 'TRUE'),
('3', 'Aktiva Tetap', '0', 1, 'TRUE'),
('4', 'Kewajiban', '0', 2, 'TRUE'),
('5', 'Kewajiban Jangka Panjang', '0', 2, 'TRUE'),
('6', 'Modal Penyertaan', '0', 2, 'TRUE'),
('7', 'Laba di Tahan', '0', 2, 'TRUE'),
('8', 'Pendapatan', '12', 3, 'TRUE'),
('9', 'Pendapatan Lain-lain', '0', 3, 'TRUE'),
('10', 'Biaya Penjualan', '0', 4, 'TRUE'),
('11', 'Biaya Gaji', '0', 4, 'TRUE'),
('12', 'Biaya Administrasi', '0', 4, 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `coa_class_type`
--

CREATE TABLE IF NOT EXISTS `coa_class_type` (
  `class_type_id` int(11) NOT NULL,
  `class_type_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_class_type`
--

INSERT INTO `coa_class_type` (`class_type_id`, `class_type_name`) VALUES
(1, 'Assets'),
(2, 'Liabilities'),
(3, 'Income'),
(4, 'Expense');

-- --------------------------------------------------------

--
-- Table structure for table `counter_log`
--

CREATE TABLE IF NOT EXISTS `counter_log` (
  `counter_code` varchar(15) NOT NULL,
  `counter_no` int(11) NOT NULL,
  `counter_month` int(11) NOT NULL,
  `counter_year` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter_log`
--

INSERT INTO `counter_log` (`counter_code`, `counter_no`, `counter_month`, `counter_year`) VALUES
('billing', 4, 0, '2015'),
('cn_no', 11, 0, '2015'),
('cn_transno', 11, 0, '2015'),
('dc_transno', 3, 0, '2015'),
('dn_no', 3, 0, '2015'),
('dn_transno', 3, 0, '2015'),
('dp_customer', 5, 0, '2015'),
('dp_supplier', 7, 0, '2015'),
('dp_transno', 11, 0, '2015'),
('journal_no', 3, 0, '2015'),
('journal_transno', 3, 0, '2015'),
('pv_no', 2, 0, '2015'),
('pv_transno', 2, 0, '2015'),
('rv_no', 7, 0, '2015'),
('rv_transno', 7, 0, '2015');

-- --------------------------------------------------------

--
-- Table structure for table `dn_transaction`
--

CREATE TABLE IF NOT EXISTS `dn_transaction` (
  `dn_no` varchar(20) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `branch_code` varchar(15) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `supplier_code` varchar(15) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `used_sap_amount` double NOT NULL,
  `used_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dn_transaction`
--

INSERT INTO `dn_transaction` (`dn_no`, `transaction_no`, `transaction_date`, `transaction_type_id`, `branch_code`, `dept_id`, `supplier_code`, `cp`, `used_sap_amount`, `used_amount`) VALUES
('00002', '00002', '1970-01-01', 0, '0', 0, '', '', 0, 0),
('00003', '00003', '1970-01-01', 0, '0', 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dp_customer`
--

CREATE TABLE IF NOT EXISTS `dp_customer` (
  `dc_no` varchar(20) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `dept_id` int(11) NOT NULL,
  `company_code` varchar(15) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `amount` double NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_customer`
--

INSERT INTO `dp_customer` (`dc_no`, `transaction_no`, `transaction_date`, `dept_id`, `company_code`, `cp`, `currency`, `amount`, `note`) VALUES
('00003', '00001', '0000-00-00', 0, 'COMPANY 3', '', 'AED', 100, ''),
('00005', '00003', '0000-00-00', 0, 'COMPANY 3', '', 'AMD', 222.22, '');

-- --------------------------------------------------------

--
-- Table structure for table `dp_supplier`
--

CREATE TABLE IF NOT EXISTS `dp_supplier` (
  `ds_no` varchar(20) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `dept_id` varchar(20) NOT NULL,
  `supplier_code` varchar(15) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `lg_no` varchar(20) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `amount` double NOT NULL,
  `note` text NOT NULL,
  `used_amount` double NOT NULL,
  `clearing_out` double NOT NULL,
  `clearing_in` double NOT NULL,
  `is_add_balance` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_supplier`
--

INSERT INTO `dp_supplier` (`ds_no`, `transaction_no`, `transaction_date`, `dept_id`, `supplier_code`, `cp`, `lg_no`, `currency`, `amount`, `note`, `used_amount`, `clearing_out`, `clearing_in`, `is_add_balance`) VALUES
('00003', '00007', '0000-00-00', ' TICKETING ', '0013', '', '', 'AMD', 100, '', 0, 0, 0, 'FALSE'),
('00004', '00008', '0000-00-00', ' TOUR ', '0015', '', '', 'AMD', 20, '', 0, 0, 0, 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `dp_supplier_detail`
--

CREATE TABLE IF NOT EXISTS `dp_supplier_detail` (
  `ds_detail_id` int(11) NOT NULL,
  `ds_no` varchar(15) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year`
--

CREATE TABLE IF NOT EXISTS `fiscal_year` (
  `fiscal_year_id` int(11) NOT NULL,
  `fiscal_year_start` date DEFAULT NULL,
  `fiscal_year_end` date DEFAULT NULL,
  `fiscal_year` char(4) NOT NULL,
  `fiscal_year_is_active` set('TRUE','FALSE') DEFAULT 'FALSE'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='table to set fiscal year\n';

--
-- Dumping data for table `fiscal_year`
--

INSERT INTO `fiscal_year` (`fiscal_year_id`, `fiscal_year_start`, `fiscal_year_end`, `fiscal_year`, `fiscal_year_is_active`) VALUES
(15, '2015-03-24', '2015-03-17', '2015', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_transaction`
--

CREATE TABLE IF NOT EXISTS `invoice_transaction` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(15) NOT NULL,
  `company_code` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_transaction`
--

INSERT INTO `invoice_transaction` (`invoice_id`, `invoice_no`, `company_code`, `amount`) VALUES
(1, '223', '00010', 1000),
(2, '332', '00010', 3900);

-- --------------------------------------------------------

--
-- Table structure for table `journal_transaction`
--

CREATE TABLE IF NOT EXISTS `journal_transaction` (
  `journal_no` varchar(15) NOT NULL,
  `transaction_no` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL,
  `dept_id` int(11) NOT NULL,
  `branch_code` varchar(15) NOT NULL,
  `Journal_desc` varchar(100) NOT NULL,
  `journal_db` double NOT NULL,
  `journal_cr` double NOT NULL,
  `journal_status` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `journal_print` int(11) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `journal_appr_by` int(11) NOT NULL,
  `is_journal` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `journal_transaction`
--

INSERT INTO `journal_transaction` (`journal_no`, `transaction_no`, `transaction_date`, `dept_id`, `branch_code`, `Journal_desc`, `journal_db`, `journal_cr`, `journal_status`, `journal_print`, `created_by`, `journal_appr_by`, `is_journal`) VALUES
('00002', '00002', '0000-00-00', 0, '', '', 0, 0, 'FALSE', 0, '', 0, 'FALSE'),
('00003', '00003', '0000-00-00', 0, '', '', 0, 0, 'FALSE', 0, '', 0, 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `journal_transaction_detail`
--

CREATE TABLE IF NOT EXISTS `journal_transaction_detail` (
  `journal_detail_id` int(11) NOT NULL,
  `journal_no` varchar(15) NOT NULL,
  `account_code` varchar(15) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_link` varchar(150) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `menu_position` int(11) NOT NULL,
  `menu_parent_id` int(11) NOT NULL,
  `menu_is_active` set('TRUE','FALSE') NOT NULL DEFAULT 'TRUE',
  `menu_is_report` set('TRUE','FALSE') DEFAULT 'FALSE'
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_link`, `menu_icon`, `menu_position`, `menu_parent_id`, `menu_is_active`, `menu_is_report`) VALUES
(1, 'Dashboard', '/dashboard/main/index', 'fa-dashboard', 1, 0, 'TRUE', 'FALSE'),
(2, 'Configuration', '#', 'fa-gear', 2, 0, 'TRUE', 'FALSE'),
(3, 'Accounting', '#', 'fa-bar-chart-o', 3, 0, 'TRUE', 'FALSE'),
(4, 'Cashier', '#', 'fa-money', 4, 0, 'TRUE', 'FALSE'),
(5, 'Setting', '#', 'fa-hand-o-down', 5, 0, 'TRUE', 'FALSE'),
(6, 'COA', '/configuration/coa/index', '', 0, 2, 'TRUE', 'FALSE'),
(7, 'Customer', '/configuration/company/index', '', 0, 2, 'TRUE', 'FALSE'),
(8, 'Supplier', '/configuration/supplier/index', '', 0, 2, 'TRUE', 'FALSE'),
(9, 'COA Balance', '/configuration/coa_balance/index', '', 0, 2, 'TRUE', 'FALSE'),
(10, 'COA Setting', '/configuration/coa_settings/index', '', 0, 2, 'TRUE', 'FALSE'),
(11, 'Currency', '/configuration/currency/index', '', 0, 2, 'TRUE', 'FALSE'),
(12, 'Journal', 'accounting/journal/form', '', 0, 3, 'TRUE', 'FALSE'),
(13, 'Payment Voucher', 'accounting/pv/index', '', 0, 3, 'TRUE', 'FALSE'),
(14, 'Receipt Voucher', 'accounting/rv/index', '', 0, 3, 'TRUE', 'FALSE'),
(15, 'PV/RV Approval', 'accounting/approval/index', '', 0, 3, 'TRUE', 'FALSE'),
(16, 'Credit Note', 'accounting/credit_note/index', '', 0, 3, 'TRUE', 'FALSE'),
(17, 'Debit Note', 'accounting/debit_note/index', '', 0, 3, 'TRUE', 'FALSE'),
(18, 'Refund', 'accounting/refund/index', '', 0, 3, 'TRUE', 'FALSE'),
(19, 'Sales Counter', 'cashier/sales_counter/index', '', 1, 4, 'TRUE', 'FALSE'),
(20, 'Cheque B/G', 'cashier/cheque_bg/index', '', 5, 4, 'TRUE', 'FALSE'),
(21, 'Credit Card', 'cashier/credit_card/index', '', 6, 4, 'TRUE', 'FALSE'),
(22, 'Cash Advance', 'cashier/cash_advance/index', '', 7, 4, 'TRUE', 'FALSE'),
(23, 'DP From Customer', 'cashier/dp_customer/index', '', 8, 4, 'TRUE', 'FALSE'),
(24, 'DP TO Suppler', 'cashier/dp_supplier/index', '', 9, 4, 'TRUE', 'FALSE'),
(25, 'User Account', 'settings/user_accounts/index', '', 0, 5, 'TRUE', 'FALSE'),
(26, 'Group Account', 'settings/group_account/index', '', 0, 5, 'TRUE', 'FALSE'),
(27, 'Company Setting', 'settings/company/index', '', 0, 5, 'TRUE', 'FALSE'),
(28, 'Reports', 'accounting/reports/index', '', 0, 3, 'TRUE', 'FALSE'),
(29, 'Reports', 'cashier/reports/index', '', 12, 4, 'TRUE', 'FALSE'),
(30, 'Daily Sales', '/reports/daily_sales/index', '', 0, 28, 'TRUE', 'TRUE'),
(31, 'Sales By Department', '/reports/sales_by_dept/index', '', 0, 28, 'TRUE', 'TRUE'),
(32, 'AP Summary', '/reports/ap_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(33, 'AR Summary', '/reports/ar_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(34, 'Aging Schedule', '/reports/aging_schedule/index', '', 0, 28, 'TRUE', 'TRUE'),
(35, 'AP Statement Summary', '/reports/ap_statement_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(36, 'PV/RV/CN Summary', '/reports/pv_rv_cn_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(37, 'Refund Summary', '/reports/refund_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(38, 'Outstanding Transaction', '/reports/outstanding_transaction/index', '', 0, 28, 'TRUE', 'TRUE'),
(39, 'Tour Cost Summary', '/reports/tour_cost_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(40, 'Invoice Status', '/reports/invoice_status/index', '', 0, 28, 'TRUE', 'TRUE'),
(41, 'List Of Currency', '/reports/list_of_currency/index', '', 0, 28, 'TRUE', 'TRUE'),
(42, 'List Of Cheque/BG', '/reports/list_of_cheque/index', '', 0, 28, 'TRUE', 'TRUE'),
(43, 'Journal Memorial Summary', '/reports/journal_memorial_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(44, 'Back Office Journal Summary', '/reports/back_office_journal_summary/index', '', 0, 28, 'TRUE', 'TRUE'),
(45, 'Ledger', '/reports/ledger/index', '', 0, 28, 'TRUE', 'TRUE'),
(46, 'Sub Ledger', '/reports/sub_ledger/index', '', 0, 28, 'TRUE', 'TRUE'),
(47, 'Trial Balance', '/reports/trial_balance/index', '', 0, 28, 'TRUE', 'TRUE'),
(48, 'Income Statement', '/reports/income_statement/index', '', 0, 28, 'TRUE', 'TRUE'),
(49, 'Gain Loss Forex', '/reports/gain_loss_forex/index', '', 0, 28, 'TRUE', 'TRUE'),
(50, 'Balance Sheet Consolidation', '/reports/balance_sheet_consolidation/index', '', 0, 28, 'TRUE', 'TRUE'),
(51, 'Transaction Summary', '/reports/transaction_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(52, 'DP/Cash Advance Summary', '/reports/dp_cash_advance_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(53, 'Cash Flow', '/reports/cash_flow/index', '', 0, 29, 'TRUE', 'TRUE'),
(54, 'Cash Request Summary', '/reports/cash_request_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(55, 'Outstanding Cashier Transaction', '/reports/outstanding_cashier_transaction/index', '', 0, 29, 'TRUE', 'TRUE'),
(56, 'Bank Statement', '/reports/bank_statement/index', '', 0, 29, 'TRUE', 'TRUE'),
(57, 'Internal Transfer Summary', '/reports/internal_transfer_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(58, 'Non Cash Transaction Summary', '/reports/non_cash_transaction_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(59, 'List Currency', '/reports/list_currency/index', '', 0, 29, 'TRUE', 'TRUE'),
(60, 'Stock Invoice', '/reports/stock_invoice/index', '', 0, 29, 'TRUE', 'TRUE'),
(61, 'Customer Billing Summary', '/reports/customer_billing_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(62, 'Clearing Summary', '/reports/clearing_summary/index', '', 0, 29, 'TRUE', 'TRUE'),
(63, 'Fiscal year', '/settings/fiscal_year/index', '', 0, 5, 'TRUE', 'FALSE'),
(64, 'Transfer', '', '', 10, 4, 'TRUE', 'FALSE'),
(65, 'Internal Trasnfer', '', '', 11, 4, 'TRUE', 'FALSE'),
(66, 'COA Type', '/configuration/coa_type/index', '', 0, 6, 'TRUE', 'FALSE'),
(67, 'COA Class', '/configuration/coa_class/index', '', 0, 6, 'TRUE', 'FALSE'),
(68, 'COA Group', '/configuration/coa_group/index', '', 0, 6, 'TRUE', 'FALSE'),
(69, 'COA Account', '/configuration/coa_account/index', '', 0, 6, 'TRUE', 'FALSE'),
(70, 'Bank Account', '/configuration/bank_account/index', '', 0, 6, 'TRUE', 'FALSE'),
(71, 'Billing', '/cashier/billing/index', '', 2, 4, 'TRUE', 'FALSE'),
(72, 'Clearing B/G', '/cashier/clearing/index', '', 3, 4, 'TRUE', 'FALSE'),
(73, 'Cleared', '/cashier/cleared/index', '', 4, 4, 'TRUE', 'FALSE'),
(74, 'Payment Transaction', '/cashier/payment_transaction/index', '', 5, 4, 'TRUE', 'FALSE'),
(75, 'Invoice Cashier Transaction', '/cashier/invoice_cashier_transaction/index', '', 6, 4, 'TRUE', 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `mst_bank`
--

CREATE TABLE IF NOT EXISTS `mst_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_desc` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_bank`
--

INSERT INTO `mst_bank` (`bank_id`, `bank_name`, `bank_desc`) VALUES
(1, 'BANK BCA', 'BANK CENTRAL ASIA'),
(2, 'BANK MANDIRI', 'BANK MANDIRI');

-- --------------------------------------------------------

--
-- Table structure for table `mst_company`
--

CREATE TABLE IF NOT EXISTS `mst_company` (
  `company_code` varchar(15) NOT NULL DEFAULT '',
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(225) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `negara` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `currency` char(10) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `add_user` int(10) DEFAULT NULL,
  `modified_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_company`
--

INSERT INTO `mst_company` (`company_code`, `company_name`, `company_address`, `kode_pos`, `kota`, `negara`, `phone`, `email`, `status`, `currency`, `add_date`, `modified_date`, `add_user`, `modified_user`) VALUES
('00010', 'COMPANY 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-09 10:53:21', '2015-02-09 10:53:21', NULL, NULL),
('00011', 'COMPANY 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-09 10:53:21', '2015-02-09 10:53:21', NULL, NULL),
('00012', 'COMPANY 12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-09 10:53:21', '2015-02-09 10:53:21', NULL, NULL),
('00013', 'COMPANY 13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-09 10:53:21', '2015-02-09 10:53:21', NULL, NULL),
('00014', 'COMPANY 14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-09 10:53:22', '2015-02-09 10:53:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_currency`
--

CREATE TABLE IF NOT EXISTS `mst_currency` (
  `currency` varchar(5) NOT NULL DEFAULT '',
  `symbol` varchar(5) NOT NULL,
  `currency_name` varchar(50) NOT NULL,
  `currency_country` varchar(30) NOT NULL,
  `desc` varchar(150) NOT NULL,
  `add_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `add_user` int(10) DEFAULT NULL,
  `modified_user` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_currency`
--

INSERT INTO `mst_currency` (`currency`, `symbol`, `currency_name`, `currency_country`, `desc`, `add_date`, `modified_date`, `add_user`, `modified_user`) VALUES
('AED', '', '', '', '', NULL, NULL, NULL, NULL),
('AFN', '', '', '', '', NULL, NULL, NULL, NULL),
('ALL', '', '', '', '', NULL, NULL, NULL, NULL),
('AMD', '', '', '', '', NULL, NULL, NULL, NULL),
('ANG', '', '', '', '', NULL, NULL, NULL, NULL),
('AOA', '', '', '', '', NULL, NULL, NULL, NULL),
('ARS', '', '', '', '', NULL, NULL, NULL, NULL),
('AUD', '', '', '', '', NULL, NULL, NULL, NULL),
('AWG', '', '', '', '', NULL, NULL, NULL, NULL),
('AZN', '', '', '', '', NULL, NULL, NULL, NULL),
('BAM', '', '', '', '', NULL, NULL, NULL, NULL),
('BBD', '', '', '', '', NULL, NULL, NULL, NULL),
('BDT', '', '', '', '', NULL, NULL, NULL, NULL),
('BGN', '', '', '', '', NULL, NULL, NULL, NULL),
('BHD', '', '', '', '', NULL, NULL, NULL, NULL),
('BIF', '', '', '', '', NULL, NULL, NULL, NULL),
('BMD', '', '', '', '', NULL, NULL, NULL, NULL),
('BND', '', '', '', '', NULL, NULL, NULL, NULL),
('BOB', '', '', '', '', NULL, NULL, NULL, NULL),
('BRL', '', '', '', '', NULL, NULL, NULL, NULL),
('BSD', '', '', '', '', NULL, NULL, NULL, NULL),
('BTN', '', '', '', '', NULL, NULL, NULL, NULL),
('BWP', '', '', '', '', NULL, NULL, NULL, NULL),
('BYR', '', '', '', '', NULL, NULL, NULL, NULL),
('BZD', '', '', '', '', NULL, NULL, NULL, NULL),
('CAD', '', '', '', '', NULL, NULL, NULL, NULL),
('CDF', '', '', '', '', NULL, NULL, NULL, NULL),
('CHF', '', '', '', '', NULL, NULL, NULL, NULL),
('CLP', '', '', '', '', NULL, NULL, NULL, NULL),
('CNY', '', '', '', '', NULL, NULL, NULL, NULL),
('COP', '', '', '', '', NULL, NULL, NULL, NULL),
('CRC', '', '', '', '', NULL, NULL, NULL, NULL),
('CUP', '', '', '', '', NULL, NULL, NULL, NULL),
('CVE', '', '', '', '', NULL, NULL, NULL, NULL),
('CZK', '', '', '', '', NULL, NULL, NULL, NULL),
('DJF', '', '', '', '', NULL, NULL, NULL, NULL),
('DKK', '', '', '', '', NULL, NULL, NULL, NULL),
('DOP', '', '', '', '', NULL, NULL, NULL, NULL),
('DZD', '', '', '', '', NULL, NULL, NULL, NULL),
('EGP', '', '', '', '', NULL, NULL, NULL, NULL),
('ERN', '', '', '', '', NULL, NULL, NULL, NULL),
('ETB', '', '', '', '', NULL, NULL, NULL, NULL),
('EUR', '', '', '', '', NULL, NULL, NULL, NULL),
('FJD', '', '', '', '', NULL, NULL, NULL, NULL),
('FKP', '', '', '', '', NULL, NULL, NULL, NULL),
('GBP', '', '', '', '', NULL, NULL, NULL, NULL),
('GEL', '', '', '', '', NULL, NULL, NULL, NULL),
('GHS', '', '', '', '', NULL, NULL, NULL, NULL),
('GIP', '', '', '', '', NULL, NULL, NULL, NULL),
('GMD', '', '', '', '', NULL, NULL, NULL, NULL),
('GNF', '', '', '', '', NULL, NULL, NULL, NULL),
('GTQ', '', '', '', '', NULL, NULL, NULL, NULL),
('GYD', '', '', '', '', NULL, NULL, NULL, NULL),
('HKD', '', '', '', '', NULL, NULL, NULL, NULL),
('HNL', '', '', '', '', NULL, NULL, NULL, NULL),
('HRK', '', '', '', '', NULL, NULL, NULL, NULL),
('HTG', '', '', '', '', NULL, NULL, NULL, NULL),
('HUF', '', '', '', '', NULL, NULL, NULL, NULL),
('IDR', '', '', '', '', NULL, NULL, NULL, NULL),
('ILS', '', '', '', '', NULL, NULL, NULL, NULL),
('INR', '', '', '', '', NULL, NULL, NULL, NULL),
('IQD', '', '', '', '', NULL, NULL, NULL, NULL),
('IRR', '', '', '', '', NULL, NULL, NULL, NULL),
('ISK', '', '', '', '', NULL, NULL, NULL, NULL),
('JMD', '', '', '', '', NULL, NULL, NULL, NULL),
('JOD', '', '', '', '', NULL, NULL, NULL, NULL),
('JPY', '', '', '', '', NULL, NULL, NULL, NULL),
('KES', '', '', '', '', NULL, NULL, NULL, NULL),
('KGS', '', '', '', '', NULL, NULL, NULL, NULL),
('KHR', '', '', '', '', NULL, NULL, NULL, NULL),
('KMF', '', '', '', '', NULL, NULL, NULL, NULL),
('KPW', '', '', '', '', NULL, NULL, NULL, NULL),
('KRW', '', '', '', '', NULL, NULL, NULL, NULL),
('KWD', '', '', '', '', NULL, NULL, NULL, NULL),
('KYD', '', '', '', '', NULL, NULL, NULL, NULL),
('KZT', '', '', '', '', NULL, NULL, NULL, NULL),
('LAK', '', '', '', '', NULL, NULL, NULL, NULL),
('LBP', '', '', '', '', NULL, NULL, NULL, NULL),
('LKR', '', '', '', '', NULL, NULL, NULL, NULL),
('LRD', '', '', '', '', NULL, NULL, NULL, NULL),
('LSL', '', '', '', '', NULL, NULL, NULL, NULL),
('LTL', '', '', '', '', NULL, NULL, NULL, NULL),
('LYD', '', '', '', '', NULL, NULL, NULL, NULL),
('MAD', '', '', '', '', NULL, NULL, NULL, NULL),
('MDL', '', '', '', '', NULL, NULL, NULL, NULL),
('MGA', '', '', '', '', NULL, NULL, NULL, NULL),
('MKD', '', '', '', '', NULL, NULL, NULL, NULL),
('MMK', '', '', '', '', NULL, NULL, NULL, NULL),
('MNT', '', '', '', '', NULL, NULL, NULL, NULL),
('MOP', '', '', '', '', NULL, NULL, NULL, NULL),
('MRO', '', '', '', '', NULL, NULL, NULL, NULL),
('MUR', '', '', '', '', NULL, NULL, NULL, NULL),
('MVR', '', '', '', '', NULL, NULL, NULL, NULL),
('MWK', '', '', '', '', NULL, NULL, NULL, NULL),
('MXN', '', '', '', '', NULL, NULL, NULL, NULL),
('MYR', '', '', '', '', NULL, NULL, NULL, NULL),
('MZN', '', '', '', '', NULL, NULL, NULL, NULL),
('NAD', '', '', '', '', NULL, NULL, NULL, NULL),
('NGN', '', '', '', '', NULL, NULL, NULL, NULL),
('NIO', '', '', '', '', NULL, NULL, NULL, NULL),
('NOK', '', '', '', '', NULL, NULL, NULL, NULL),
('NPR', '', '', '', '', NULL, NULL, NULL, NULL),
('NZD', '', '', '', '', NULL, NULL, NULL, NULL),
('OMR', '', '', '', '', NULL, NULL, NULL, NULL),
('PAB', '', '', '', '', NULL, NULL, NULL, NULL),
('PEN', '', '', '', '', NULL, NULL, NULL, NULL),
('PGK', '', '', '', '', NULL, NULL, NULL, NULL),
('PHP', '', '', '', '', NULL, NULL, NULL, NULL),
('PKR', '', '', '', '', NULL, NULL, NULL, NULL),
('PLN', '', '', '', '', NULL, NULL, NULL, NULL),
('PYG', '', '', '', '', NULL, NULL, NULL, NULL),
('QAR', '', '', '', '', NULL, NULL, NULL, NULL),
('RON', '', '', '', '', NULL, NULL, NULL, NULL),
('RSD', '', '', '', '', NULL, NULL, NULL, NULL),
('RUB', '', '', '', '', NULL, NULL, NULL, NULL),
('RWF', '', '', '', '', NULL, NULL, NULL, NULL),
('SAR', '', '', '', '', NULL, NULL, NULL, NULL),
('SBD', '', '', '', '', NULL, NULL, NULL, NULL),
('SCR', '', '', '', '', NULL, NULL, NULL, NULL),
('SDG', '', '', '', '', NULL, NULL, NULL, NULL),
('SEK', '', '', '', '', NULL, NULL, NULL, NULL),
('SGD', '', '', '', '', NULL, NULL, NULL, NULL),
('SHP', '', '', '', '', NULL, NULL, NULL, NULL),
('SLL', '', '', '', '', NULL, NULL, NULL, NULL),
('SOS', '', '', '', '', NULL, NULL, NULL, NULL),
('SRD', '', '', '', '', NULL, NULL, NULL, NULL),
('SSP', '', '', '', '', NULL, NULL, NULL, NULL),
('STD', '', '', '', '', NULL, NULL, NULL, NULL),
('SYP', '', '', '', '', NULL, NULL, NULL, NULL),
('SZL', '', '', '', '', NULL, NULL, NULL, NULL),
('THB', '', '', '', '', NULL, NULL, NULL, NULL),
('TJS', '', '', '', '', NULL, NULL, NULL, NULL),
('TMT', '', '', '', '', NULL, NULL, NULL, NULL),
('TND', '', '', '', '', NULL, NULL, NULL, NULL),
('TOP', '', '', '', '', NULL, NULL, NULL, NULL),
('TRY', '', '', '', '', NULL, NULL, NULL, NULL),
('TTD', '', '', '', '', NULL, NULL, NULL, NULL),
('TWD', '', '', '', '', NULL, NULL, NULL, NULL),
('TZS', '', '', '', '', NULL, NULL, NULL, NULL),
('UAH', '', '', '', '', NULL, NULL, NULL, NULL),
('UGX', '', '', '', '', NULL, NULL, NULL, NULL),
('USD', '$', 'US Dollar', '', '', NULL, NULL, NULL, NULL),
('UYU', '', '', '', '', NULL, NULL, NULL, NULL),
('UZS', '', '', '', '', NULL, NULL, NULL, NULL),
('VEF', '', '', '', '', NULL, NULL, NULL, NULL),
('VND', '', '', '', '', NULL, NULL, NULL, NULL),
('VUV', '', '', '', '', NULL, NULL, NULL, NULL),
('WST', '', '', '', '', NULL, NULL, NULL, NULL),
('XAF', '', '', '', '', NULL, NULL, NULL, NULL),
('XCD', '', '', '', '', NULL, NULL, NULL, NULL),
('XOF', '', '', '', '', NULL, NULL, NULL, NULL),
('XPF', '', '', '', '', NULL, NULL, NULL, NULL),
('YER', '', '', '', '', NULL, NULL, NULL, NULL),
('ZAR', '', '', '', '', NULL, NULL, NULL, NULL),
('ZMK', '', '', '', '', NULL, NULL, NULL, NULL),
('ZWL', '', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_dept`
--

CREATE TABLE IF NOT EXISTS `mst_dept` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_dept`
--

INSERT INTO `mst_dept` (`dept_id`, `dept_name`) VALUES
(1, 'TICKETING'),
(2, 'HOTEL'),
(3, 'TOUR'),
(4, 'DOCUMENT');

-- --------------------------------------------------------

--
-- Table structure for table `mst_supplier`
--

CREATE TABLE IF NOT EXISTS `mst_supplier` (
  `supplier_code` varchar(15) NOT NULL,
  `supplier_name` varchar(50) DEFAULT NULL,
  `supplier_address` varchar(100) DEFAULT NULL,
  `supplier_address2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_supplier`
--

INSERT INTO `mst_supplier` (`supplier_code`, `supplier_name`, `supplier_address`, `supplier_address2`) VALUES
('0001', 'Supplier I', 'a', 'c'),
('0002', 'Supplier II', 'a', 'c'),
('0003', 'Supplier III', 'a', 'c'),
('0004', 'Supplier IV', 'a', 'c'),
('0005', 'Supplier V', 'a', 'c'),
('0006', 'Supplier VI', 'a', 'c'),
('0007', 'Suplier 7', NULL, NULL),
('0008', 'Suplier 8', NULL, NULL),
('0009', 'Suplier 9', NULL, NULL),
('0010', 'Suplier 10', NULL, NULL),
('0011', 'Suplier 11', NULL, NULL),
('0012', 'Suplier 12', NULL, NULL),
('0013', 'Suplier 13', NULL, NULL),
('0014', 'Suplier 14', NULL, NULL),
('0015', 'Suplier 15', NULL, NULL),
('0016', 'Suplier 16', NULL, NULL),
('0017', 'Suplier 17', NULL, NULL),
('0018', 'Suplier 18', NULL, NULL),
('0019', 'Suplier 19', NULL, NULL),
('0020', 'Suplier 20', NULL, NULL),
('0021', 'Suplier 21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_name` varchar(50) NOT NULL,
  `payment_method_desc` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method_name`, `payment_method_desc`) VALUES
(1, 'TICKET', ''),
(2, 'HOTEL', ''),
(3, 'DOCUMENT', ''),
(4, 'TOUR', ''),
(5, 'CRUISE', ''),
(6, 'OTHERS', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE IF NOT EXISTS `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_name` varchar(50) NOT NULL,
  `payment_type_desc` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_name`, `payment_type_desc`) VALUES
(1, 'AP/Adjustment', ''),
(2, 'Add Discount', ''),
(3, 'Expenses', ''),
(4, 'Keep Comm', ''),
(5, 'Others CN', ''),
(6, 'Refund', ''),
(7, 'Sale Retur', ''),
(8, 'Others', '');

-- --------------------------------------------------------

--
-- Table structure for table `pv_transaction`
--

CREATE TABLE IF NOT EXISTS `pv_transaction` (
  `pv_no` varchar(20) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `lg_no` varchar(20) NOT NULL,
  `receipt_by` varchar(30) NOT NULL,
  `branch_code` varchar(20) NOT NULL,
  `due_date` date NOT NULL,
  `supplier_code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pv_transaction`
--

INSERT INTO `pv_transaction` (`pv_no`, `transaction_no`, `transaction_date`, `payment_type_id`, `payment_method_id`, `lg_no`, `receipt_by`, `branch_code`, `due_date`, `supplier_code`) VALUES
('00001', '00001', '2015-04-14', 0, 0, '', '', '', '2015-04-23', ''),
('22', '32', '2015-04-06', 3, 0, '', '', '', '1970-01-01', '0012');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_type`
--

CREATE TABLE IF NOT EXISTS `receipt_type` (
  `receipt_type_id` int(11) NOT NULL,
  `receipt_type_name` varchar(50) NOT NULL,
  `receipt_type_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reff_log`
--

CREATE TABLE IF NOT EXISTS `reff_log` (
  `id_log` int(10) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `action` varchar(100) DEFAULT NULL,
  `record` text,
  `table_transaction` varchar(100) DEFAULT NULL,
  `event_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `refund_transaction`
--

CREATE TABLE IF NOT EXISTS `refund_transaction` (
  `refund_no` varchar(15) NOT NULL,
  `transaction_no` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rv_transaction`
--

CREATE TABLE IF NOT EXISTS `rv_transaction` (
  `rv_no` varchar(20) NOT NULL,
  `transaction_no` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `receipt_type_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `branch_code` varchar(15) NOT NULL,
  `rv_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rv_transaction`
--

INSERT INTO `rv_transaction` (`rv_no`, `transaction_no`, `transaction_date`, `receipt_type_id`, `dept_id`, `branch_code`, `rv_note`) VALUES
('00006', '00006', '1970-01-01', 0, 0, 'COMPANY 24', ''),
('00007', '00007', '1970-01-01', 0, 0, 'COMPANY 24', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `setting_data` text NOT NULL,
  `setting_created_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `company_name`, `setting_data`, `setting_created_date`) VALUES
(1, 'PT ABC', '{"company_name":"PT ABC","director":"BUDI GUNAWAN","address":"JL. PEJATEN BARAT RAYA NO 30A PASAR MINGGU","address2":"JAKARTA","zip_code":"11111","country":"INDONESIA","state":"DKI JAKARTA","city":"JAKARTA","phone":"1111","fax":"111","email":"AAA@AAA.COM","npwp":"1111"}', '2015-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `user_is_active` set('TRUE','FALSE') NOT NULL DEFAULT 'FALSE',
  `active_date` date NOT NULL,
  `active_by` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_password`, `user_name`, `user_group_id`, `user_is_active`, `active_date`, `active_by`, `last_login`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1, 'TRUE', '0000-00-00', 0, '2015-04-30 04:40:50', '0000-00-00', 0, '0000-00-00', 0),
(2, 'test', '202cb962ac59075b964b07152d234b70', 'test 123', 3, 'TRUE', '0000-00-00', 0, '0000-00-00 00:00:00', '2015-03-23', 0, '2015-03-23', 0),
(3, 'widi', '', 'widi agustin', 0, 'FALSE', '0000-00-00', 0, '2015-03-16 10:05:58', '0000-00-00', 0, '0000-00-00', 0),
(5, 'budi', '', 'Budi Setiawan', 0, 'FALSE', '0000-00-00', 0, '2015-03-16 12:07:54', '0000-00-00', 0, '0000-00-00', 0),
(8, 'yudi', '202cb962ac59075b964b07152d234b70', 'yudi bintang 3', 4, 'TRUE', '0000-00-00', 0, '2015-03-19 18:16:59', '0000-00-00', 0, '2015-03-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_group_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `group_name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Supervisor'),
(4, 'User'),
(0, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
  `permission_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `crud_action` varchar(100) NOT NULL,
  `other_action` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`permission_id`, `user_group_id`, `user_id`, `menu_id`, `crud_action`, `other_action`) VALUES
(1, 1, 0, 1, '', ''),
(2, 1, 0, 2, '', ''),
(3, 1, 0, 3, '', ''),
(4, 1, 0, 4, '', ''),
(5, 1, 0, 5, '', ''),
(6, 1, 0, 6, '', ''),
(7, 1, 0, 7, '', ''),
(8, 1, 0, 8, '', ''),
(9, 1, 0, 9, '', ''),
(10, 1, 0, 10, '', ''),
(11, 1, 0, 11, '', ''),
(12, 1, 0, 12, '', ''),
(13, 1, 0, 13, '', ''),
(14, 1, 0, 14, '', ''),
(15, 1, 0, 15, '', ''),
(16, 1, 0, 16, '', ''),
(17, 1, 0, 17, '', ''),
(18, 1, 0, 18, '', ''),
(19, 1, 0, 19, '', ''),
(20, 1, 0, 20, '', ''),
(21, 1, 0, 21, '', ''),
(22, 1, 0, 22, '', ''),
(23, 1, 0, 23, '', ''),
(24, 1, 0, 24, '', ''),
(25, 1, 0, 25, '', ''),
(26, 1, 0, 26, '', ''),
(27, 1, 0, 27, '', ''),
(28, 1, 0, 28, '', ''),
(29, 1, 0, 29, '', ''),
(30, 1, 0, 30, '', ''),
(31, 1, 0, 31, '', ''),
(32, 1, 0, 32, '', ''),
(33, 1, 0, 33, '', ''),
(34, 1, 0, 34, '', ''),
(35, 1, 0, 35, '', ''),
(36, 1, 0, 36, '', ''),
(37, 1, 0, 37, '', ''),
(38, 1, 0, 38, '', ''),
(39, 1, 0, 39, '', ''),
(40, 1, 0, 40, '', ''),
(41, 1, 0, 41, '', ''),
(42, 1, 0, 42, '', ''),
(43, 1, 0, 43, '', ''),
(44, 1, 0, 44, '', ''),
(45, 1, 0, 45, '', ''),
(46, 1, 0, 46, '', ''),
(47, 1, 0, 47, '', ''),
(48, 1, 0, 48, '', ''),
(49, 1, 0, 49, '', ''),
(50, 1, 0, 50, '', ''),
(51, 1, 0, 51, '', ''),
(52, 1, 0, 52, '', ''),
(53, 1, 0, 53, '', ''),
(54, 1, 0, 54, '', ''),
(55, 1, 0, 55, '', ''),
(56, 1, 0, 56, '', ''),
(57, 1, 0, 57, '', ''),
(58, 1, 0, 58, '', ''),
(59, 1, 0, 59, '', ''),
(60, 1, 0, 60, '', ''),
(61, 1, 0, 61, '', ''),
(62, 1, 0, 62, '', ''),
(63, 1, 0, 63, '', ''),
(64, 1, 0, 64, '', ''),
(65, 1, 0, 65, '', ''),
(66, 1, 0, 66, '', ''),
(67, 1, 0, 67, '', ''),
(68, 1, 0, 68, '', ''),
(69, 1, 0, 69, '', ''),
(70, 1, 0, 70, '', ''),
(71, 1, 0, 71, '', ''),
(72, 1, 0, 72, '', ''),
(73, 1, 0, 73, '', ''),
(74, 1, 1, 74, '', ''),
(75, 1, 1, 75, '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mst_branch`
--
CREATE TABLE IF NOT EXISTS `view_mst_branch` (
`company_code` varchar(15)
,`company_name` varchar(100)
,`company_address` varchar(225)
,`kode_pos` varchar(10)
,`kota` varchar(100)
,`negara` varchar(100)
,`phone` varchar(100)
,`email` varchar(100)
,`status` int(1)
,`currency` char(10)
,`add_date` datetime
,`modified_date` datetime
,`add_user` int(10)
,`modified_user` int(10)
);

-- --------------------------------------------------------

--
-- Structure for view `view_mst_branch`
--
DROP TABLE IF EXISTS `view_mst_branch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mst_branch` AS select `mst_company`.`company_code` AS `company_code`,`mst_company`.`company_name` AS `company_name`,`mst_company`.`company_address` AS `company_address`,`mst_company`.`kode_pos` AS `kode_pos`,`mst_company`.`kota` AS `kota`,`mst_company`.`negara` AS `negara`,`mst_company`.`phone` AS `phone`,`mst_company`.`email` AS `email`,`mst_company`.`status` AS `status`,`mst_company`.`currency` AS `currency`,`mst_company`.`add_date` AS `add_date`,`mst_company`.`modified_date` AS `modified_date`,`mst_company`.`add_user` AS `add_user`,`mst_company`.`modified_user` AS `modified_user` from `mst_company`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_account_id`);

--
-- Indexes for table `bank_account_type`
--
ALTER TABLE `bank_account_type`
  ADD PRIMARY KEY (`bank_account_type_id`);

--
-- Indexes for table `billing_transaction`
--
ALTER TABLE `billing_transaction`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `billing_transaction_detail`
--
ALTER TABLE `billing_transaction_detail`
  ADD PRIMARY KEY (`bill_detail_id`);

--
-- Indexes for table `cc_transaction`
--
ALTER TABLE `cc_transaction`
  ADD PRIMARY KEY (`cc_no`);

--
-- Indexes for table `cheque_transaction`
--
ALTER TABLE `cheque_transaction`
  ADD PRIMARY KEY (`cheque_no`);

--
-- Indexes for table `cn_transaction`
--
ALTER TABLE `cn_transaction`
  ADD PRIMARY KEY (`cn_no`);

--
-- Indexes for table `coa_account`
--
ALTER TABLE `coa_account`
  ADD PRIMARY KEY (`account_code`);

--
-- Indexes for table `coa_class`
--
ALTER TABLE `coa_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `coa_class_group`
--
ALTER TABLE `coa_class_group`
  ADD PRIMARY KEY (`coa_group_id`);

--
-- Indexes for table `coa_class_type`
--
ALTER TABLE `coa_class_type`
  ADD PRIMARY KEY (`class_type_id`);

--
-- Indexes for table `counter_log`
--
ALTER TABLE `counter_log`
  ADD PRIMARY KEY (`counter_code`);

--
-- Indexes for table `dn_transaction`
--
ALTER TABLE `dn_transaction`
  ADD PRIMARY KEY (`dn_no`);

--
-- Indexes for table `dp_customer`
--
ALTER TABLE `dp_customer`
  ADD PRIMARY KEY (`dc_no`);

--
-- Indexes for table `dp_supplier`
--
ALTER TABLE `dp_supplier`
  ADD PRIMARY KEY (`ds_no`);

--
-- Indexes for table `dp_supplier_detail`
--
ALTER TABLE `dp_supplier_detail`
  ADD PRIMARY KEY (`ds_detail_id`);

--
-- Indexes for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  ADD PRIMARY KEY (`fiscal_year_id`);

--
-- Indexes for table `invoice_transaction`
--
ALTER TABLE `invoice_transaction`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `journal_transaction`
--
ALTER TABLE `journal_transaction`
  ADD PRIMARY KEY (`journal_no`);

--
-- Indexes for table `journal_transaction_detail`
--
ALTER TABLE `journal_transaction_detail`
  ADD PRIMARY KEY (`journal_detail_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `mst_bank`
--
ALTER TABLE `mst_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `mst_company`
--
ALTER TABLE `mst_company`
  ADD PRIMARY KEY (`company_code`);

--
-- Indexes for table `mst_currency`
--
ALTER TABLE `mst_currency`
  ADD PRIMARY KEY (`currency`);

--
-- Indexes for table `mst_dept`
--
ALTER TABLE `mst_dept`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `mst_supplier`
--
ALTER TABLE `mst_supplier`
  ADD PRIMARY KEY (`supplier_code`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `pv_transaction`
--
ALTER TABLE `pv_transaction`
  ADD PRIMARY KEY (`pv_no`);

--
-- Indexes for table `receipt_type`
--
ALTER TABLE `receipt_type`
  ADD PRIMARY KEY (`receipt_type_id`);

--
-- Indexes for table `reff_log`
--
ALTER TABLE `reff_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `refund_transaction`
--
ALTER TABLE `refund_transaction`
  ADD PRIMARY KEY (`refund_no`);

--
-- Indexes for table `rv_transaction`
--
ALTER TABLE `rv_transaction`
  ADD PRIMARY KEY (`rv_no`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `bank_account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank_account_type`
--
ALTER TABLE `bank_account_type`
  MODIFY `bank_account_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `billing_transaction_detail`
--
ALTER TABLE `billing_transaction_detail`
  MODIFY `bill_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `coa_class`
--
ALTER TABLE `coa_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1112;
--
-- AUTO_INCREMENT for table `coa_class_group`
--
ALTER TABLE `coa_class_group`
AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `coa_class_type`
--
ALTER TABLE `coa_class_type`
AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dp_supplier_detail`
--
ALTER TABLE `dp_supplier_detail`
  MODIFY `ds_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  MODIFY `fiscal_year_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `invoice_transaction`
--
ALTER TABLE `invoice_transaction`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `journal_transaction_detail`
--
ALTER TABLE `journal_transaction_detail`
  MODIFY `journal_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `mst_bank`
--
ALTER TABLE `mst_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mst_dept`
--
ALTER TABLE `mst_dept`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `receipt_type`
--
ALTER TABLE `receipt_type`
  MODIFY `receipt_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reff_log`
--
ALTER TABLE `reff_log`
  MODIFY `id_log` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

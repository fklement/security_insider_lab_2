<?php
/*
 ** FILE: config.php
 ** PURPOSE: contains all configuration information
 ** AUTHOR(S): Daniel Schreckling
*/

global $htbconf;

$xorValue	= 0x0BADC0DE;
// paths
$htbconf['paths/prefix']	= '/var/www/html/';
$htbconf['paths/pages']	= 'pages/';

// url of this bank
// $htbconf['web/baseurl']	= 'http://www.unsecurito.it/';
$htbconf['web/baseurl']	= 'http://localhost:8001';

// Bank description
$htbconf['bank/name']	= 'Unsecurito Italiano';
$htbconf['bank/code']	= '41131337';

// this and its xored value must be smaller than 0xfffffff (268435455)
$htbconf['bank/accountBase']	= '120070201';
$htbconf['bank/interest']	= '4.2';
$htbconf['bank/logo']	= 'Sphinx_Logo.gif';
$htbconf['bank/sid']	= 'USECURITYID';
$htbconf['bank/cookievalidity']	= '604800';

// Names of DataBase tables
$htbconf['db/accounts']		= 'accounts';
$htbconf['db/banks']		= 'banks';
$htbconf['db/branches']		= 'branches';
$htbconf['db/currencies']	= 'currencies';
$htbconf['db/loans']		= 'loans';
$htbconf['db/transfers']	= 'transfers';
$htbconf['db/types']		= 'typesAcc';
$htbconf['db/users']		= 'users';

// Attributes of table account
$htbconf['db/accounts.account']	= 'account';
$htbconf['db/accounts.owner']	= 'owner';
$htbconf['db/accounts.type']	= 'type';
$htbconf['db/accounts.branch']	= 'branch';
$htbconf['db/accounts.currency']	= 'currency';
$htbconf['db/accounts.deposit']	= 'deposit';
$htbconf['db/accounts.curbal']	= 'curbal';
$htbconf['db/accounts.time']	= 'modtime';

// Attributes of table bank
$htbconf['db/banks.id']		= 'id';
$htbconf['db/banks.name']	= 'name';
$htbconf['db/banks.code']	= 'code';

// Attributes of table branches
$htbconf['db/branches.id']	= 'id';
$htbconf['db/branches.name']	= 'name';

// Attributes of table currencies
$htbconf['db/currencies.id']	= 'id';
$htbconf['db/currencies.name']	= 'name';

// Attributes of table loans
$htbconf['db/loans.id']			= 'id';
$htbconf['db/loans.owner']		= 'owner';
$htbconf['db/loans.creditacc']	= 'creditacc';
$htbconf['db/loans.debitacc']	= 'debitacc';
$htbconf['db/loans.amount']		= 'amount';
$htbconf['db/loans.period']		= 'period';
$htbconf['db/loans.interest']	= 'interest';
$htbconf['db/loans.time']		= 'time';

// Attributes of table transfers
$htbconf['db/transfers.id']			= 'id';
$htbconf['db/transfers.time']		= 'time';
$htbconf['db/transfers.dstacc']		= 'dstacc';
$htbconf['db/transfers.dstbank']	= 'dstbank';
$htbconf['db/transfers.srcacc']		= 'srcacc';
$htbconf['db/transfers.srcbank']	= 'srcbank';
$htbconf['db/transfers.remark']		= 'remark';
$htbconf['db/transfers.amount']		= 'amount';

// Attributes of table types
$htbconf['db/types.id']			= 'id';
$htbconf['db/types.name']		= 'name';

// Attributes of table users
$htbconf['db/users.id']			= 'id';
$htbconf['db/users.password']	= 'password';
$htbconf['db/users.username']	= 'username';
$htbconf['db/users.name']		= 'name';
$htbconf['db/users.firstname']	= 'firstname';
$htbconf['db/users.time']		= 'time';
$htbconf['db/users.lasttime']	= 'lasttime';
$htbconf['db/users.lastip']		= 'lastip';

// Application account for access to database
$htbconf['db/.server']	= 'mariadb';
$htbconf['db/.login']	= 'root';
$htbconf['db/.pwd']		= '';
$htbconf['db/.name']	= 'vbank';

date_default_timezone_set('Europe/Berlin');
?>

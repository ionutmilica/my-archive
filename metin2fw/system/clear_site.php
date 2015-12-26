<?php

$DB = Mysql::init();

/**
 * Stergem timpul de asteptare pentru codul de stergere al caracterelor
**/

$DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `socialid_expire`='0' WHERE `socialid_expire` < '".time()."' AND `socialid_expire` != '0'");

/**
 * Stergem timpul de asteptare pentru schimbarea adresei de email
**/

$DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `email_expire`='0' WHERE `email_expire` < '".time()."' AND `email_expire` != '0'");
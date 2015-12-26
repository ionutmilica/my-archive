<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Administrare cont');

check_login();

assign('content_tpl', 'content/administration');
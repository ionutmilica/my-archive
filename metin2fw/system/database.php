<?php

$CFG->load('database');

$DB = Mysql::init($CFG->get('mysql_host'), $CFG->get('mysql_user'), $CFG->get('mysql_password'), $CFG->get('mysql_database'));

$DB->set_names();

Registry::init()->set('DB', $DB);

$CFG->unload('database');
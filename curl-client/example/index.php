<?php

require '../cURL.php';

$client = new cURL;

$client->get('action', 'login');

$client->post('username', 'admin')
	   ->post('password', 'admin');

echo $client->navigate('http://localhost/uvt/curl/example/test.php');
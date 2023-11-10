<?php

use App\Authentification;
use App\Connection;

Authentification::check();

$cssFile = $jsFile = 'admin';
$pdo = Connection::getPDO();

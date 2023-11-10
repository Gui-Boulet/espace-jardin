<?php

use App\Authentification;
use App\Connection;
use App\Table\ServiceTable;

Authentification::check();

$cssFile = $jsFile = 'admin';
$pdo = Connection::getPDO();

// Suppression d'un service - Deleting a service
(new ServiceTable($pdo))->deleteService($_POST['service-id']);

// Redirige vers la page administration des services - Redirects to services administration page
header('Location: ' . $router->url('admin_services'));
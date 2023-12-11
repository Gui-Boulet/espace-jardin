<?php

use App\Authentification;
use App\Connection;
use App\Table\ServiceTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('home'));
  exit();
}

$cssFile = 'admin';
$pdo = Connection::getPDO();

// Suppression d'un service - Deleting a service
(new ServiceTable($pdo))->deleteService($_POST['id']);

// Redirige vers la page administration des services - Redirects to services administration page
header('Location: ' . $router->url('admin_services'));
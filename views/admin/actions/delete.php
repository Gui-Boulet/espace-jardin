<?php

use App\Authentification;
use App\Connection;
use App\Table\InterventionTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('login'));
  exit();
}

$cssFile = 'admin';

if (!empty($_POST)) {

  $pdo = Connection::getPDO();
  $interventionTable = new InterventionTable($pdo);

  // Suppression d'une intervention - Deleting a intervention
  $interventionTable->deleteIntervention($_POST['id']);
  $_SESSION['id'] = $_POST['customer_id'];
  $_SESSION['success'] = 1;
}

// Redirige vers la page administration des services - Redirects to services administration page
header('Location: ' . $router->url('admin_customers'));
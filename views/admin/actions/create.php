<?php

use App\Authentification;
use App\Connection;
use App\Model\Intervention;
use App\Table\InterventionTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('login'));
  exit();
}

$cssFile = 'admin';
$pdo = Connection::getPDO();

if (!empty($_POST)) {
  // Si les données viennent de la page Clients - If the data comes from the Customers page ----------------------------
  if (!empty($_POST['week'])) {
    $interventionTable = new InterventionTable($pdo);
    $intervention = new Intervention();    

    $intervention
      ->setWeek(str_replace('-W', '', $_POST['week']))
      ->setCustomerId($_POST['customer_id'])
      ->setServiceId($_POST['service_id']);
    
    // Insertion d'une nouvelle intervention - Inserting a new intervention
    $interventionTable->insertIntervention($intervention);
    $_SESSION['id'] = $_POST['customer_id'];
    $_SESSION['success'] = 1;

    // Redirige vers la page administration des clients - Redirects to customers administration page
    header('Location: ' . $router->url('admin_customers'));
    exit();
  }
}
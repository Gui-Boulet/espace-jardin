<?php

use App\Authentification;
use App\Connection;
use App\Table\CustomerTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('home'));
  exit();
}

$cssFile = 'admin';
$pdo = Connection::getPDO();

$customerTable = new CustomerTable($pdo);

if (!empty($_POST)) {
  $customerGarden = $customerTable->findCustomerGarden($_POST['user_id']);
  
  $customerGarden
    ->setGardenSize($_POST['garden_size'])
    ->setHedgeLength($_POST['hedge_length'])
    ->setFruitTree($_POST['fruit_tree'])
    ->setShrub($_POST['shrub'])
    ->setSmallTree($_POST['small_tree'])
    ->setBigTree($_POST['big_tree'])
    ->setNote($_POST['note']);
  
  // Modification des données du jardin du client - Updating of the customer's garden data
  $customerTable->updateCustomerGarden($customerGarden);
  $_SESSION['id'] = $_POST['user_id'];
}
// Redirige vers la page administration des clients - Redirects to customers administration page
header('Location: ' . $router->url('admin_customers'));
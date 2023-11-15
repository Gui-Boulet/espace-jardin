<?php

use App\Authentification;
use App\Connection;
use App\Table\CustomerTable;

Authentification::check();

$cssFile = $jsFile = 'admin';
$pdo = Connection::getPDO();

$customerTable = new CustomerTable($pdo);

$success = 0;

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
  
  $customerTable->updateCustomerGarden($customerGarden);
  $success = 1;
}
// Redirige vers la page administration des services - Redirects to services administration page
header('Location: ' . $router->url('admin_customers') . "?success={$success}&id={$_POST['user_id']}");
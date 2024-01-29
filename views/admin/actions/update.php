<?php

use App\Authentification;
use App\Connection;
use App\Table\CustomerTable;
use App\Table\ServiceTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('login'));
  exit();
}

$cssFile = 'admin';
$pdo = Connection::getPDO();

if (!empty($_POST)) {
  // Si les données viennent de la page Clients - If the data comes from the Customers page ----------------------------
  if (!empty($_POST['user_id']) && !empty($_POST['garden_size'])) {
    $customerTable = new CustomerTable($pdo);
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
    $_SESSION['success'] = 2;

    // Redirige vers la page administration des clients - Redirects to customers administration page
    header('Location: ' . $router->url('admin_customers'));
    exit();
  }

  // Si les données viennent de la page Services - If the data comes from the Services page ----------------------------
  if (!empty($_POST['service-id'])) {
    $serviceTable = new ServiceTable($pdo);
    $service = $serviceTable->findServiceById($_POST['service-id']);

    $service->setStatus(intval($_POST['status']));

    // Modification du statut du service - Updating the status of the service
    $serviceTable->updateService($service);

    // Redirige vers la page administration des services - Redirects to services administration page
    header('Location: ' . $router->url('admin_services'));
    exit();
  }
}
<?php

use App\Connection;
use App\Model\Customer;
use App\Model\Message;
use App\Model\User;
use App\Table\CustomerTable;
use App\Table\MessageTable;
use App\Table\UserTable;

if (!empty($_POST)) {
  $pdo = Connection::getPDO();

  $userTable = new UserTable($pdo);
  $user = new User();
  $customerTable = new CustomerTable($pdo);
  $customer = new Customer();
  $messageTable = new MessageTable($pdo);
  $message = new Message();

  $user->setEmail($_POST['email']);

  $userTable->insertUser($user);
  $user_id = ($userTable->findIdUserByEmail($_POST['email']))->getId();

  $customer
    ->setFirstName($_POST['first_name'])
    ->setLastName($_POST['last_name'])
    ->setPhone($_POST['phone'])
    ->setStreetNumber($_POST['street_number'])
    ->setStreet($_POST['street'])
    ->setZipCode($_POST['zip_code'])
    ->setCity($_POST['city'])
    ->setCountry($_POST['country'])
    ->setUserId($user_id);
  
  $customerTable->insertCustomer($customer);
  
  // Crée un message, si le message est non vide - Creates a new message, if the message is non-empty
  if (!empty($_POST['comment'])) {
    $message
      ->setComment($_POST['comment'])
      ->setUserId($user_id);
  
    $messageTable->insertMessage($message);
  }

  // Redirige vers la page d'accueil - Redirects to the homepage
  header('Location: ' . $router->url('home'));
  exit();
}
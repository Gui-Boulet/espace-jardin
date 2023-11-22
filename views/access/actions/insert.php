<?php

use App\Connection;
use App\Model\Customer;
use App\Table\CustomerTable;

$success = 0;
$customer = new Customer();

if (!empty($_POST)) {
  $pdo = Connection::getPDO();
  $customerTable = new CustomerTable($pdo);
  
  $customer
    ->setFirstName($_POST['first_name'])
    ->setLastName($_POST['last_name'])
    ->setPhone($_POST['phone'])
    ->setStreetNumber($_POST['street_number'])
    ->setStreet($_POST['street'])
    ->setZipCode($_POST['zip_code'])
    ->setCity($_POST['city'])
    ->setCountry($_POST['country']);
  
  // Insertion des données personnelles du client - Insertion of the customer's personal data
  $customerTable->insertCustomer($customer);
  $success = 1;
}
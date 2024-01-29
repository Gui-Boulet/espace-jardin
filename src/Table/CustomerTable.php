<?php

namespace App\Table;

use App\Model\Customer;
use PDO;

final class CustomerTable extends Table {

  protected $table = 'customers';
  protected $class = Customer::class;


  // Retourne les données d'un client en fonction de son id - Returns a customer's data based on their id
  // ----------------------------------------------------------------------------------------------------
  public function findCustomer(string $id)
  {
    $this->sql = 
      "SELECT first_name, last_name, phone, street_number, street, zip_code, city, country,
        garden_size, hedge_length, fruit_tree, shrub, small_tree, big_tree, u.email
      FROM {$this->table}
      JOIN users AS u ON u.id = user_id
      WHERE user_id = :user_id";
    
    $this->param = ['user_id' => $id];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Retourne la liste des clients ordonnés par nom de famille - Returns the list of customers ordered by last name
  // --------------------------------------------------------------------------------------------------------------
  public function findCustomers(): array
  {
    $this->sql = 
    "SELECT u.email, first_name, last_name, phone, street_number, street, zip_code, city, country,
        garden_size, hedge_length, fruit_tree, shrub, small_tree, big_tree, note, user_id
      FROM {$this->table}
      JOIN users AS u ON u.id = user_id
      ORDER BY last_name";
    
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';

    return $this->getDatas();
  }

  // Retourne les informations concernant l'attribut de type ENUM garden_size de la table customers
  // Returns information about the ENUM type attribute garden_size of the customers table
  // ----------------------------------------------------------------------------------------------
  public function findGardenSizes(): array
  {
    $this->sql = "SHOW COLUMNS FROM {$this->table} LIKE 'garden_size'";

    $this->fetchMode = PDO::FETCH_ASSOC;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Retourne les données du jardin d'un client - Returns data from a customer's garden
  // ----------------------------------------------------------------------------------
  public function findCustomerGarden(string $id)
  {
    $this->sql = 
      "SELECT garden_size, hedge_length, fruit_tree, shrub, small_tree, big_tree, note, user_id
      FROM {$this->table}
      WHERE user_id = :user_id";
    
    $this->param = ['user_id' => $id];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Modifie les données du jardin du client - Updates the customer's garden data
  // ----------------------------------------------------------------------------
  public function updateCustomerGarden(Customer $customer): void
  {
    $this->sql = 
    "UPDATE {$this->table}
      SET garden_size = :garden_size, hedge_length = :hedge_length, fruit_tree = :fruit_tree, shrub = :shrub,
        small_tree = :small_tree, big_tree = :big_tree, note = :note
      WHERE user_id = :user_id
    ";

    $this->param = [
      'user_id' => $customer->getUserId(),
      'garden_size' => $customer->getGardenSize(),
      'hedge_length' => $customer->getHedgeLength(),
      'fruit_tree' => $customer->getFruitTree(),
      'shrub' => $customer->getShrub(),
      'small_tree' => $customer->getSmallTree(),
      'big_tree' => $customer->getBigTree(),
      'note' => $customer->getNote()
    ];

    $this->manageDatas();
  }

  // Insère les données personnelles du client - Inserts the customer's personal data
  // --------------------------------------------------------------------------------
  public function insertCustomer(Customer $customer): void
  {
    $this->sql = 
      "INSERT INTO {$this->table}
      SET first_name = :first_name, last_name = :last_name, phone = :phone, street_number = :street_number,
        street = :street, zip_code = :zip_code, city = :city, country = :country, user_id = :user_id";

    $this->param = [
      'first_name' => $customer->getFirstName(),
      'last_name' => $customer->getLastName(),
      'phone' => str_replace(' ', '',$customer->getPhone()),
      'street_number' => $customer->getStreetNumber(),
      'street' => $customer->getStreet(),
      'zip_code' => $customer->getZipCode(),
      'city' => $customer->getCity(),
      'country' => $customer->getCountry(),
      'user_id' => $customer->getUserId()
    ];

    $this->manageDatas();
  }
}
<?php

namespace App\Table;

use App\Model\Customer;

final class CustomerTable extends Table {

  protected $table = 'customers';
  protected $class = Customer::class;
  protected $fetchFunction = 'fetchAll';

  // Retourne les données d'un client en fonction de son id - Returns a customer's data based on their id
  public function findCustomer(int $id)
  {
    $this->sql = "
      SELECT u.email, c.first_name, c.last_name, c.phone, c.street_number, c.street, c.zip_code, c.city, c.country,
        c.user_id
      FROM {$this->table} AS c
      JOIN users AS u ON u.id = c.user_id
      WHERE c.user_id = :user_id
    ";
    $this->param = ['user_id' => $id];
    return $this->getDatasClass();
  }

  // Retourne la liste des clients ordonnés par nom de famille - Returns the list of customers ordered by last name
  public function findCustomers(): array
  {
    $this->sql = "
      SELECT u.email, c.first_name, c.last_name, c.phone, c.street_number, c.street, c.zip_code, c.city, c.country,
        c.garden_size, c.hedge_length, c.fruit_tree, c.shrub, c.small_tree, c.big_tree, c.note, c.user_id
      FROM {$this->table} AS c
      JOIN users AS u ON u.id = c.user_id
      ORDER BY c.last_name
    ";
    return $this->getDatasClass();
  }

  // Retourne les informations concernant l'attribut de type ENUM garden_size de la table customers
  // Returns information about the ENUM type attribute garden_size of the customers table
  public function findGardenSizes(): array
  {
    $this->sql = "SHOW COLUMNS FROM customers LIKE 'garden_size'";
    return $this->getDatas();
  }

  // Retourne les données du jardin d'un client - Returns data from a customer's garden
  public function findCustomerGarden(int $id)
  {
    $this->sql = "
      SELECT c.garden_size, c.hedge_length, c.fruit_tree, c.shrub, c.small_tree, c.big_tree, c.note, c.user_id
      FROM {$this->table} AS c
      WHERE c.user_id = :user_id
    ";
    $this->param = ['user_id' => $id];
    $this->fetchFunction = 'fetch';
    return $this->getDatasClass();
  }

  // Modifie les données du jardin du client - Updates the customer's garden data
  public function updateCustomerGarden(Customer $customer): void
  {
    $this->sql = "
      UPDATE {$this->table} AS c
      SET c.garden_size = :garden_size, c.hedge_length = :hedge_length, c.fruit_tree = :fruit_tree, c.shrub = :shrub,
        c.small_tree = :small_tree, c.big_tree = :big_tree, c.note = :note
      WHERE c.user_id = :user_id
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
    $this->updateDatas();
  }
}
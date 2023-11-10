<?php

namespace App\Table;

use App\Model\Customer;

final class CustomerTable extends Table {

  protected $table = 'customers AS c';
  protected $class = Customer::class;

  // Retourne les données d'un client en fonction de son id - Returns a customer's data based on their id
  public function findCustomer(int $id)
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['u.email', 'c.first_name', 'c.last_name', 'c.phone', 'c.street_number', 'c.street', 'c.zip_code', 'c.city',
        'c.country', 'c.user_id'],
      ['users AS u ON u.id = c.user_id'],
      'c.user_id = :id',
      [],
      ''
    );
    $this->param = ['id' => $id];
    return $this->getDatasClass();
  }

  // Retourne la liste des clients ordonnés par nom de famille - Returns the list of customers ordered by last name
  public function findCustomers(): array
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['u.email', 'c.first_name', 'c.last_name', 'c.phone', 'c.street_number', 'c.street', 'c.zip_code', 'c.city',
        'c.country', 'c.garden_size', 'c.hedge_length', 'c.fruit_tree', 'c.shrub', 'c.small_tree', 'c.big_tree',
        'c.note', 'c.user_id'],
      ['users AS u ON u.id = c.user_id'],
      '',
      [],
      'c.last_name'
    );
    return $this->getDatasClass();
  }
}
<?php

namespace App\Table;

use App\Model\Customer;
use App\Model\Intervention;
use App\Model\Service;
use PDO;
use Ramsey\Uuid\Uuid;

final class InterventionTable extends Table {

  protected $table = 'interventions';
  protected $class = Intervention::class;

  // Retourne la liste des interventions ordonnées par semaine - Returns the list of interventions ordered by week
  // -------------------------------------------------------------------------------------------------------------
  public function findInterventions(): array
  {
    $this->sql = 
      "SELECT i.id, i.week, customer_id, service_id
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week";

    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';
    $interventions['inter'] = $this->getDatas();

    $this->sql = 
      "SELECT s.name
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week";

    $this->class = Service::class;
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';
    $interventions['serv'] = $this->getDatas();

    $this->sql = 
      "SELECT c.first_name, c.last_name, c.phone, c.street_number, c.street, c.zip_code, c.city, c.country
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week";

    $this->class = Customer::class;
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';
    $interventions['cust'] = $this->getDatas();

    return $interventions;
  }

  // Retourne les prochaines interventions prévues groupées par service et client
  // Returns next scheduled interventions grouped by service and client
  // ----------------------------------------------------------------------------
  public function findNextInterventions(): array
  {
    $this->sql = 
      "SELECT id, service_id, customer_id, MIN(week) AS week
      FROM {$this->table}
      WHERE week >= CONCAT(YEAR(CURRENT_DATE()), LPAD(WEEK(CURRENT_DATE(), 3), 2, '0'))
      GROUP BY id, service_id, customer_id
      ORDER BY week";
    
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';

    return $this->getDatas();
  }

  // Retourne les prochaines interventions d'un client donné - Returns the next actions of a given customer
  // ------------------------------------------------------------------------------------------------------
  public function findNextInterventionsByCustomer(string $customer_id): array
  {
    $this->sql = 
    "SELECT id, service_id, MIN(week) AS week
    FROM {$this->table}
    WHERE customer_id = :customer_id AND week >= CONCAT(YEAR(CURRENT_DATE()), LPAD(WEEK(CURRENT_DATE(), 3), 2, '0'))
    GROUP BY id, service_id
    ORDER BY week";

    $this->param = ['customer_id' => $customer_id];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';

    return $this->getDatas();
  }

  // Retourne les dernières interventions effectuées groupées par service et client
  // Returns last interventions carried out grouped by service and customer
  // ------------------------------------------------------------------------------
  public function findLastInterventions(): array
  {
    $this->sql = 
      "SELECT service_id, customer_id, MAX(week) AS week
      FROM {$this->table}
      WHERE week < CONCAT(YEAR(CURRENT_DATE()), LPAD(WEEK(CURRENT_DATE(), 3), 2, '0'))
      GROUP BY service_id, customer_id
      ORDER BY week DESC";
    
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';
    
    return $this->getDatas();
  }

  // Insère une nouvelle intervention dans la base de donnée - Inserts a new intervention into the database
  // ------------------------------------------------------------------------------------------------------
  public function insertIntervention(Intervention $intervention): void
  {
    $this->sql = 
      "INSERT INTO {$this->table} SET id = :id, week = :week, customer_id = :customer_id, service_id = :service_id";

    $this->param = [
      'id' => (Uuid::uuid4())->toString(),
      'week' => $intervention->getWeek(),
      'customer_id' => $intervention->getCustomerId(),
      'service_id' => $intervention->getServiceId()
    ];

    $this->manageDatas();
  }

  // Supprime une intervention dans la base de données - Deletes a intervention into the database
  // --------------------------------------------------------------------------------------------
  public function deleteIntervention(string $id): void
  {
    $this->sql = "DELETE FROM {$this->table} WHERE id = :id";
    $this->param = ['id' => $id];
    $this->manageDatas();
  }
}
<?php

namespace App\Table;

use App\Model\Customer;
use App\Model\Intervention;
use App\Model\Service;
use PDO;

final class InterventionTable extends Table {

  protected $table = 'interventions';
  protected $class = Intervention::class;
  protected $fetchMode = PDO::FETCH_CLASS;
  protected $fetchFunction = 'fetchAll';

  // Retourne la liste des interventions ordonnées par semaine - Returns the list of interventions ordered by week
  public function findInterventions(): array
  {
    $this->sql = "
      SELECT i.id, i.week, customer_id, service_id
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week
    ";
    $interventions['inter'] = $this->getDatas();

    $this->sql = "
      SELECT s.name
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week
    ";
    $this->class = Service::class;
    $interventions['serv'] = $this->getDatas();

    $this->sql = "
      SELECT c.first_name, c.last_name, c.phone, c.street_number, c.street, c.zip_code, c.city, c.country
      FROM {$this->table} AS i
      JOIN services AS s ON s.id = i.service_id
      JOIN customers AS c ON c.user_id = i.customer_id
      ORDER BY i.week
    ";
    $this->class = Customer::class;
    $interventions['cust'] = $this->getDatas();
    return $interventions;
  }

  // Retourne les prochaines interventions prévues groupées par service et client ordonnées par semaine
  // Returns next scheduled interventions grouped by service and client ordered by week
  public function findNextInterventions(): array
  {
    $this->sql = "
      SELECT i.service_id, i.customer_id, MIN(i.week) AS week
      FROM {$this->table} AS i
      WHERE CAST(i.week AS UNSIGNED) >= CONCAT(YEAR(NOW()), WEEK(NOW(), 1))
      GROUP BY i.service_id, i.customer_id
      ORDER BY week
    ";
    return $this->getDatas();
  }

  // Retourne les dernières interventions effectuées groupées par service et client ordonnées par semaine
  // Returns last interventions carried out grouped by service and customer ordered by week
  public function findLastInterventions(): array
  {
    $this->sql = "
      SELECT i.service_id, i.customer_id, MAX(i.week) AS week
      FROM {$this->table} AS i
      WHERE CAST(i.week AS UNSIGNED) < CONCAT(YEAR(NOW()), WEEK(NOW(), 1))
      GROUP BY i.service_id, i.customer_id
      ORDER BY week
    ";
    return $this->getDatas();
  }
}
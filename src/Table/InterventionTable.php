<?php

namespace App\Table;

use App\Model\Customer;
use App\Model\Intervention;
use App\Model\Service;

final class InterventionTable extends Table {

  protected $table = 'interventions AS i';
  protected $class = Intervention::class;

  // Retourne la liste des interventions ordonnées par semaine - Returns the list of interventions ordered by week
  public function findInterventions(): array
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['i.id', 'i.week', 'customer_id', 'service_id'],
      ['services AS s ON s.id = i.service_id', 'customers AS c ON c.user_id = i.customer_id'],
      '',
      [],
      'i.week'
    );
    $interventions['inter'] = $this->getDatasClass();

    $this->sql = $this->makeQuery(
      'SELECT',
      ['s.name'],
      ['services AS s ON s.id = i.service_id', 'customers AS c ON c.user_id = i.customer_id'],
      '',
      [],
      'i.week'
    );
    $this->class = Service::class;
    $interventions['serv'] = $this->getDatasClass();

    $this->sql = $this->makeQuery(
      'SELECT',
      ['c.first_name', 'c.last_name', 'c.phone', 'c.street_number', 'c.street', 'c.zip_code', 'c.city', 'c.country'],
      ['services AS s ON s.id = i.service_id', 'customers AS c ON c.user_id = i.customer_id'],
      '',
      [],
      'i.week'
    );
    $this->class = Customer::class;
    $interventions['cust'] = $this->getDatasClass();
    return $interventions;
  }

  // Retourne les prochaines interventions prévues groupées par service et client ordonnées par semaine
  // Returns next scheduled interventions grouped by service and client ordered by week
  public function findNextInterventions(): array
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['i.service_id', 'i.customer_id', 'MIN(i.week) AS week'],
      [],
      'CAST(i.week AS UNSIGNED) >= CONCAT(YEAR(NOW()), WEEK(NOW(), 1))',
      ['i.service_id', 'i.customer_id'],
      'week'
    );
    return $this->getDatasClass();
  }

  // Retourne les dernières interventions effectuées groupées par service et client ordonnées par semaine
  // Returns last interventions carried out grouped by service and customer ordered by week
  public function findLastInterventions(): array
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['i.service_id', 'i.customer_id', 'MAX(i.week) AS week'],
      [],
      'CAST(i.week AS UNSIGNED) < CONCAT(YEAR(NOW()), WEEK(NOW(), 1))',
      ['i.service_id', 'i.customer_id'],
      'week'
    );
    return $this->getDatasClass();
  }
}
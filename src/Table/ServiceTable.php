<?php

namespace App\Table;

use App\Model\Service;

final class ServiceTable extends Table {

  protected $table = 'services';
  protected $class = Service::class;
  protected $fetchFunction = 'fetchAll';

  // Retourne la liste des services - Returns the list of services
  public function findServices(): array
  {
    $this->sql = "SELECT s.id, s.name FROM {$this->table} AS s";
    return $this->getDatasClass();
  }

  public function insertService()
  {

  }

  // Supprime un service dans la base de donnée - Deletes a service in the database
  public function deleteService(int $id): void
  {
    $this->sql = "DELETE FROM {$this->table} AS s WHERE s.id = :id";
    $this->param = ['id' => $id];
    $this->deleteDatas();
  }
}
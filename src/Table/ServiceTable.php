<?php

namespace App\Table;

use App\Model\Service;

final class ServiceTable extends Table {

  protected $table = 'services AS s';
  protected $class = Service::class;

  // Retourne la liste des services - Returns the list of services
  public function findServices(): array
  {
    $this->sql = $this->makeQuery('SELECT', ['s.id', 's.name'], [], '', [], '');
    return $this->getDatasClass();
  }

  public function createService()
  {

  }

  // Supprime un service dans la base de donnée - Deletes a service in the database
  public function deleteService(int $id)
  {
    $this->sql = $this->makeQuery('DELETE',[], [], 's.id = :id', [], '');
    $this->param = ['id' => $id];
    $this->exception = `Impossible de supprimer ce service, car il est réservé par un client`;
    $this->deleteDatas();
  }
}
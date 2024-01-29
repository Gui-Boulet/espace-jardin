<?php

namespace App\Table;

use App\Model\Service;
use PDO;

final class ServiceTable extends Table {

  protected $table = 'services';
  protected $class = Service::class;

  // Retourne la liste des services - Returns the list of services
  // -------------------------------------------------------------
  public function findServices(): array
  {
    $this->sql = "SELECT id, name, status FROM {$this->table} ORDER BY name";

    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';

    return $this->getDatas();
  }

  // Retourne la liste des services actifs - Returns the list of active services
  // ---------------------------------------------------------------------------
  public function findActiveServices(): array
  {
    $this->sql = "SELECT id, name FROM {$this->table} WHERE status = :status ORDER BY name";

    $this->param = ['status' => 1];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';

    return $this->getDatas();
  }

  // Retourne un service en fonction de l'id - Returns a service based on the id
  // ---------------------------------------------------------------------------
  public function findServiceById(int $id)
  {
    $this->sql = "SELECT id, status FROM {$this->table} WHERE id = :id";

    $this->param = ['id' => $id];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Met à jour un service dans la base de donnée - Updates a service in the database
  // --------------------------------------------------------------------------------
  public function updateService(Service $service): void
  {
    $this->sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";

    $this->param = [
      'id' => $service->getId(),
      'status' => $service->getStatus()
    ];

    $this->manageDatas();
  }
}
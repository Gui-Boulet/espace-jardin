<?php

namespace App\Table;

use Exception;
use PDO;

abstract class Table {

  protected $pdo;
  protected $table = null;
  protected $sql = null;
  protected $class = null;
  protected $param = null;
  protected $fetchMode = null;
  protected $fetchFunction = null;
  protected $exception = null;

  public function __construct(PDO $pdo)
  {
    if ($this->table === null){
      throw new Exception('La classe ' . get_class($this) . ' n\'a pas de propriété \$table');
    }
    if ($this->class === null){
      throw new Exception('La classe ' . get_class($this) . ' n\'a pas de propriété \$class');
    }
    $this->pdo = $pdo;
  }

  // Retourne le résultat après exécution d'une requête préparée - Returns the result after executing a prepared query
  // -----------------------------------------------------------------------------------------------------------------
  private function initRequest()
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);
    
    # Exécution de la requête / Executing the query
    $query->execute($this->param);
    
    return $query;
  }

  // Retourne les données récupérées - Returns the recovered data
  // ------------------------------------------------------------
  public function getDatas()
  {    
    $query = $this->initRequest();

    # Définition du mode de récupération des données / Defining the data recovery mode
    if ($this->fetchMode === PDO::FETCH_CLASS) {
      $query->setFetchMode($this->fetchMode, $this->class);
    } else {
      $query->setFetchMode($this->fetchMode);
    }

    # Récupération des données / Retrieve data
    $datas = $query->{$this->fetchFunction}();

    return $datas;
  }

  // Gère les données dans la base de données - Manages datas from the database
  // --------------------------------------------------------------------------
  public function manageDatas(): void
  {
    $query = $this->initRequest();
    
    if ($query === false) {
      throw new Exception($this->exception);
    }
  }
}
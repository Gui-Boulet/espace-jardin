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
  protected $fetchFunction = null;
  protected $exception = null;

  public function __construct(PDO $pdo)
  {
    if ($this->table === null){
      throw new Exception('La classe ' . get_class($this)) . ' n\'a pas de propriété \$table';
    }
    if ($this->class === null){
      throw new Exception('La classe ' . get_class($this)) . ' n\'a pas de propriété \$class';
    }
    $this->pdo = $pdo;
  }

  // Retourne un tableau d'objets de la classe spécifiée, créés à partir des données récupérées via la requête SQL
  // Returns an array of objects of the specified class, created from the data retrieved via the SQL query
  public function getDatasClass()
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);

    # Exécution de la requête / Executing the query
    $query->execute($this->param);
    
    # Définition du mode de récupération des données / Defining the Data Recovery Mode
    # PDO::FETCH_CLASS est le mode pour retourner les données sous forme d'objets de la classe spécifiée
    # PDO::FETCH_CLASS is the mode for returning data as objects of the specified class
    $query->setFetchMode(PDO::FETCH_CLASS, $this->class);

    # Récupération des données sous forme de tableau / Retrieve data in tabular form
    $datas = $query->{$this->fetchFunction}();

    return $datas;
  }

  public function getDatas(): array
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);

    # Exécution de la requête / Executing the query
    $query->execute($this->param);
    
    # Définition du mode de récupération des données / Defining the Data Recovery Mode
    $query->setFetchMode(PDO::FETCH_ASSOC);

    $datas = $query->fetch();

    return $datas;
  }

  // Supprime des données dans la base de données - Deletes datas from the database
  public function deleteDatas(): void
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);

    # Exécution de la requête / Executing the query
    $result = $query->execute($this->param);
    
    if ($result === false) {
      throw new Exception($this->exception);
    }
  }

  // Modifie les données dans la base de données - Updates datas from the database
  public function updateDatas(): void
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);

    # Exécution de la requête / Executing the query
    $result = $query->execute($this->param);
    
    if ($result === false) {
      throw new Exception($this->exception);
    }
  }
}
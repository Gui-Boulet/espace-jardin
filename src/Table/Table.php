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

  // Retourne une requête SQL - Returns a SQL query
  public function makeQuery(string $type, ?array $attributes, ?array $join, ?string $where,
    ?array $groupBy, ?string $orderBy): string
  {
    $columns = '';
    if (!empty($attributes)){
      if (count($attributes) > 1) {
        for ($i = 0; $i < count($attributes)-1; $i++) {
          $columns .= $attributes[$i] . ', ';
        }
        $columns .= $attributes[count($attributes)-1];
      } else {
        $columns .= $attributes[0];
      }
    }

    $this->sql = $type . ' ' . $columns . ' FROM ' . $this->table;

    if (!empty($join)) {
      for ($j = 0; $j < count($join); $j++) {
        $this->sql .= ' JOIN ' . $join[$j];
      }
    }

    if (!empty($where)) {
      $this->sql .= ' WHERE ' . $where;
    }

    if (!empty($groupBy)) {
      $elementGroupBy = '';
      if (count($attributes) > 1) {
        for ($i = 0; $i < count($groupBy)-1; $i++) {
          $elementGroupBy .= $groupBy[$i] . ', ';
        }
        $elementGroupBy .= $groupBy[count($groupBy)-1];
      } else {
        $elementGroupBy .= $groupBy[0];
      }
      $this->sql .= ' GROUP BY ' . $elementGroupBy;
    }

    if (!empty($orderBy)) {
      $this->sql .= ' ORDER BY ' . $orderBy;
    }
    return $this->sql;
  }

  // Retourne un tableau d'objets de la classe spécifiée, créés à partir des données récupérées via la requête SQL
  // Returns an array of objects of the specified class, created from the data retrieved via the SQL query
  public function getDatasClass(): array
  {
    # Préparation de la requête SQL envoyée en paramètre / Preparing the SQL query sent as a parameter
    $query = $this->pdo->prepare($this->sql);

    # Exécution de la requête / Executing the query
    $query->execute($this->param);
    
    # Définition du mode de récupération des données / Defining the Data Recovery Mode
    # PDO::FETCH_CLASS est le mode pour retourner les données sous forme d'objets de la classe spécifiée
    # PDO::FETCH_CLASS is the mode for returning data as objects of the specified class
    $query->setFetchMode(PDO::FETCH_CLASS, $this->class);

    # Récupération de toutes les données sous forme de tableau / Retrieve all data in tabular form
    $datas = $query->fetchAll();

    return $datas;
  }

  // Supprime des données dans la base de données - Deletes data from the database
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
}
<?php

namespace App;

use PDO;

class Connection {

  private static $dsn = 'mysql:host=localhost;dbname=garden';
  private static $username = 'root';
  private static $password = 'R00T_My5q!';

  /* Retourne un objet de type PDO pour se connecter à la base de données */
  /* Returns a PDO object to connect to the database */
  public static function getPDO(): PDO
  {
    # Définition du mode de gestion des erreurs et lancement d'une exception de type PDOException
    # Setting the error handling mode and throwing a PDOException exception
    return new PDO(self::$dsn, self::$username, self::$password,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  }
}
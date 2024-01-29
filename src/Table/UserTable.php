<?php

namespace App\Table;

use App\Method;
use App\Model\User;
use PDO;
use Ramsey\Uuid\Uuid;

final class UserTable extends Table {

  protected $table = 'users';
  protected $class = User::class;


  // Retourne les données d'un utilisateur en fonction de son email - Returns a user's data based on his email
  // ---------------------------------------------------------------------------------------------------------
  public function findUserByEmail(string $email)
  {
    $this->sql = 
      "SELECT id, email, password, role
      FROM {$this->table}
      WHERE email = :email";

    $this->param = ['email' => $email];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Retourne l'identifiant d'un utilisateur en fonction de son email - Returns a user's ID based on their email
  // -----------------------------------------------------------------------------------------------------------
  public function findIdUserByEmail(string $email)
  {
    $this->sql = "SELECT id FROM {$this->table} WHERE email = :email";

    $this->param = ['email' => $email];
    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetch';

    return $this->getDatas();
  }

  // Insère les données de l'utilisateur - Inserts the user's data
  // -------------------------------------------------------------
  public function insertUser(User $user): void
  {
    $this->sql = 
      "INSERT INTO {$this->table} SET id = :id, email = :email, password = :password, role = :role";
    
    $this->param = [
      'id' => (Uuid::uuid4())->toString(),
      'email' => $user->getEmail(),
      'password' => password_hash(Method::generatePassword(), PASSWORD_BCRYPT),
      'role' => 'user'
    ];

    $this->manageDatas();
  }
}
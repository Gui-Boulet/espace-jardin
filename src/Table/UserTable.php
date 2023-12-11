<?php

namespace App\Table;

use App\Model\User;
use PDO;

final class UserTable extends Table {

  protected $table = 'users';
  protected $class = User::class;
  protected $fetchMode = PDO::FETCH_CLASS;
  protected $fetchFunction = 'fetch';

  // Retourne les données d'un utilisateur en fonction de son email - Returns a user's data based on his email
  public function findUserByEmail(string $email)
  {
    $this->sql = "
      SELECT id, email, password, role
      FROM {$this->table}
      WHERE email = :email
    ";
    $this->param = ['email' => $email];
    return $this->getDatas();
  }

  // Insère les données de l'utilisateur - Inserts the user's data
  public function insertUser(User $user): void
  {
    $this->sql = "
      INSERT INTO {$this->table} (id, email, password, role)
      VALUES (UUID(), email = :email, password = :password, role = :role)
    ";
    $this->param = [
      'email' => $user->getEmail(),
      'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
      'role' => $user->getRole()
    ];

    $this->manageDatas();
  }
}
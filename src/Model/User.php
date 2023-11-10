<?php

namespace App\Model;

class User {

  protected $id;
  protected $email;
  protected $password;

  public function getId(): int
  {
    return $this->id;
  }
  public function getEmail(): string
  {
    return htmlspecialchars($this->email);
  }
  public function getPassword(): string
  {
    return htmlspecialchars($this->password);
  }
}
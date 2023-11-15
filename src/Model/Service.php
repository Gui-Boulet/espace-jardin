<?php

namespace App\Model;

use App\Method;

class Service {

  private $id;
  private $name;

  public function getId(): int
  {
    return $this->id;
  }
  public function getName(): string
  {
    return htmlspecialchars($this->name, ENT_NOQUOTES);
  }
  public function getFileName(): string
  {
    $fileName = str_replace(' ', '-', mb_strtolower(self::getName()));
    return Method::removeAccents($fileName);
  }
}
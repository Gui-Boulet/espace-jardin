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
    return htmlspecialchars($this->name);
  }
  public function getFileName(): string
  {
    $fileName = str_replace(' ', '-', mb_strtolower(htmlspecialchars($this->name)));
    return Method::removeAccents($fileName);
  }
}
<?php

namespace App\Model;

class Customer extends User {

  private $first_name;
  private $last_name;
  private $phone;
  private $street_number;
  private $street;
  private $zip_code;
  private $city;
  private $country;
  private $garden_size;
  private $hedge_length;
  private $fruit_tree;
  private $shrub;
  private $small_tree;
  private $big_tree;
  private $note;
  private $user_id;

  public function getFirstName(): string
  {
    return htmlspecialchars($this->first_name, ENT_NOQUOTES);
  }
  public function getLastName(): string
  {
    return htmlspecialchars($this->last_name, ENT_NOQUOTES);
  }
  public function getInitials(): string
  {
    $initialFirstName = substr(self::getFirstName(), 0, 1);
    $initialLastName = substr(self::getLastName(), 0, 1);
    return strtoupper($initialFirstName . $initialLastName);
  }
  public function getPhone(): string
  {
    $prefix = chunk_split(substr(htmlspecialchars($this->phone), 0, 5), 2, ' ');
    $lineNumber = trim(chunk_split(substr(htmlspecialchars($this->phone), -8), 2, ' '));
    return $prefix . $lineNumber;
  }
  public function getStreetNumber(): string
  {
    return htmlspecialchars($this->street_number);
  }
  public function getStreet(): string
  {
    return htmlspecialchars($this->street, ENT_NOQUOTES);
  }
  public function getZipCode(): int
  {
    return $this->zip_code;
  }
  public function getCity(): string
  {
    return htmlspecialchars($this->city, ENT_NOQUOTES);
  }
  public function getCountry(): string
  {
    return htmlspecialchars($this->country);
  }

  public function getGardenSize(): string
  {
    return $this->garden_size;
  }
  public function setGardenSize(string $garden_size): self
  {
    $this->garden_size = $garden_size;
    return $this;
  }

  public function getHedgeLength(): int
  {
    return $this->hedge_length;
  }
  public function setHedgeLength(int $hedge_length): self
  {
    $this->hedge_length = $hedge_length;
    return $this;
  }

  public function getFruitTree(): int
  {
    return $this->fruit_tree;
  }
  public function setFruitTree(int $fruit_tree): self
  {
    $this->fruit_tree = $fruit_tree;
    return $this;
  }

  public function getShrub(): int
  {
    return $this->shrub;
  }
  public function setShrub(int $shrub): self
  {
    $this->shrub = $shrub;
    return $this;
  }

  public function getSmallTree(): int
  {
    return $this->small_tree;
  }
  public function setSmallTree(int $small_tree): self
  {
    $this->small_tree = $small_tree;
    return $this;
  }

  public function getBigTree(): int
  {
    return $this->big_tree;
  }
  public function setBigTree(int $big_tree): self
  {
    $this->big_tree = $big_tree;
    return $this;
  }
  
  public function getNote(): string
  {
    return htmlspecialchars($this->note, ENT_NOQUOTES);
  }
  public function setNote(string $note): self
  {
    $this->note = htmlspecialchars($note, ENT_NOQUOTES);
    return $this;
  }
  
  public function getUserId(): int
  {
    return $this->user_id;
  }
}
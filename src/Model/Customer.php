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
    return htmlspecialchars($this->first_name);
  }
  public function getLastName(): string
  {
    return htmlspecialchars($this->last_name);
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
    return htmlspecialchars($this->street);
  }
  public function getZipCode(): int
  {
    return $this->zip_code;
  }
  public function getCity(): string
  {
    return htmlspecialchars($this->city);
  }
  public function getCountry(): string
  {
    return htmlspecialchars($this->country);
  }
  public function getGardenSize(): string
  {
    return $this->garden_size;
  }
  public function getHedgeLength(): int
  {
    return $this->hedge_length;
  }
  public function getFruitTree(): int
  {
    return $this->fruit_tree;
  }
  public function getShrub(): int
  {
    return $this->shrub;
  }
  public function getSmallTree(): int
  {
    return $this->small_tree;
  }
  public function getBigTree(): int
  {
    return $this->big_tree;
  }
  public function getNote(): string
  {
    return htmlspecialchars($this->note);
  }
  public function getUserId(): int
  {
    return $this->user_id;
  }
}
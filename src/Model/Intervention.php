<?php

namespace App\Model;

class Intervention {

  private $id;
  private $week;
  private $frequency;
  private $customer_id;
  private $service_id;

  public function getId(): int
  {
    return $this->id;
  }
  public function getWeekYear(): array
  {
    $weekYear = array_map(
      fn($start, $length): int => substr(htmlspecialchars($this->week), $start, $length), [0, 4], [4, 2]);
    return $weekYear;
  }
  public function getFrequency(): ?array
  {
    if ($this->frequency === null) {
      return null;
    }
    $frequency = array_map(
      fn($start, $length): string => substr(htmlspecialchars($this->frequency), $start, $length), [0, 1], [1]);
    return $frequency;
  }
  public function getCustomerId(): int
  {
    return $this->customer_id;
  }
  public function getServiceId(): int
  {
    return $this->service_id;
  }
}
<?php

namespace App\Model;

class Intervention {

  private $id;
  private $week;
  private $customer_id;
  private $service_id;

  public function getId(): string
  {
    return $this->id;
  }

  public function getWeek(): string
  {
    return $this->week;
  }
  public function getWeekYear(): array
  {
    $weekYear = array_map(
      fn($start, $length): int => substr(htmlspecialchars($this->week), $start, $length), [0, 4], [4, 2]);
    return $weekYear;
  }
  public function setWeek(string $week): self
  {
    $this->week = $week;
    return $this;
  }

  public function getCustomerId(): string
  {
    return $this->customer_id;
  }
  public function setCustomerId(string $customer_id): self
  {
    $this->customer_id = $customer_id;
    return $this;
  }

  public function getServiceId(): int
  {
    return $this->service_id;
  }
  public function setServiceId(int $service_id): self
  {
    $this->service_id = $service_id;
    return $this;
  }
}
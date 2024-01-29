<?php

namespace App\Model;

use DateTime;

class Message {

  private $id;
  private $date_comment;
  private $comment;
  private $user_id;

  public function getDateComment(): string
  {
    $dateComment = new DateTime($this->date_comment);
    return $dateComment->format('d / m / Y - H:i:s');
  }
  public function setDateComment(string $date_comment): self
  {
    $this->date_comment = $date_comment;
    return $this;
  }

  public function getComment(): string
  {
    return htmlspecialchars($this->comment, ENT_NOQUOTES);
  }
  public function setComment(string $comment): self
  {
    $this->comment = htmlspecialchars($comment, ENT_NOQUOTES);
    return $this;
  }

  public function getUserId(): string
  {
    return $this->user_id;
  }
  public function setUserId(string $user_id): self
  {
    $this->user_id = $user_id;
    return $this;
  }
}
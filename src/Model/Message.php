<?php

namespace App\Model;

use DateTime;

class Message {

  private $id;
  private $date_comment;
  private $comment;
  private $seen;
  private $user_id;
  private $nbUnreadComment;

  public function getDateComment(): string
  {
    $dateComment = new DateTime($this->date_comment);
    return $dateComment->format('d / m / Y - H:i:s');
  }
  public function getComment(): string
  {
    return htmlspecialchars($this->comment, ENT_NOQUOTES);
  }
  public function getSeen(): bool
  {
    return $this->seen;
  }
  public function getUserId(): string
  {
    return $this->user_id;
  }
  public function getNbUnreadComment(): int
  {
    return $this->nbUnreadComment;
  }
}
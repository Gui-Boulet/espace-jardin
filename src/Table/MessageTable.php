<?php

namespace App\Table;

use App\Model\Message;
use PDO;

final class MessageTable extends Table {

  protected $table = 'messages';
  protected $class = Message::class;

  // Retourne la liste des messages - Returns the list of messages
  // -------------------------------------------------------------
  public function findMessages(): array
  {
    $this->sql = "SELECT date_comment, comment, user_id FROM {$this->table}";

    $this->fetchMode = PDO::FETCH_CLASS;
    $this->fetchFunction = 'fetchAll';
    
    return $this->getDatas();
  }

  // Insère un message - Inserts the message
  // ---------------------------------------
  public function insertMessage(Message $message): void
  {
    $this->sql = "INSERT INTO {$this->table} SET date_comment = :date_comment, comment = :comment, user_id = :user_id";

    date_default_timezone_set('Europe/Paris');
    $this->param = [
      'date_comment' => date('Y-m-d H:i:s'),
      'comment' => $message->getComment(),
      'user_id' => $message->getUserId()
    ];

    $this->manageDatas();
  }
}
<?php

namespace App\Table;

use App\Model\Message;

final class MessageTable extends Table {

  protected $table = 'messages';
  protected $class = Message::class;
  protected $fetchFunction = 'fetchAll';

  // Retourne la liste des messages ordonnés du plus récent au plus ancien groupés par id et user_id
  // Returns the list of messages ordered from newest to oldest grouped by id and user_id
  public function findMessages(): array
  {
    $this->sql = "
      SELECT m.id, m.date_comment, m.comment, m.seen, m.user_id
      FROM {$this->table} AS m
      GROUP BY m.id, m.user_id
      ORDER BY m.date_comment DESC
    ";
    return $this->getDatasClass();
  }

  // Retourne le nombre de messages non lus - Returns the number of unread messages
  public function findNumberUnreadMessages()
  {
    $this->sql = "
      SELECT m.user_id, m.seen, COUNT(m.comment) AS nbUnreadComment
      FROM {$this->table} AS m
      WHERE m.seen = :seen
      GROUP BY m.user_id
    ";
    $this->param = ['seen' => 1];
    return $this->getDatasClass();
  }
}
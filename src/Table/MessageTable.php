<?php

namespace App\Table;

use App\Model\Message;

final class MessageTable extends Table {

  protected $table = 'messages AS m';
  protected $class = Message::class;

  // Retourne la liste des messages ordonnés du plus récent au plus ancien groupés par id et user_id
  // Returns the list of messages ordered from newest to oldest grouped by id and user_id
  public function findMessages(): array
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['m.id', 'm.date_comment', 'm.comment', 'm.seen', 'm.user_id'],
      [],
      '',
      ['m.id', 'm.user_id'],
      'm.date_comment DESC'
    );
    return $this->getDatasClass();
  }

  // Retourne le nombre de messages non lus - Returns the number of unread messages
  public function findNumberUnreadMessages()
  {
    $this->sql = $this->makeQuery(
      'SELECT',
      ['m.user_id', 'm.seen' , 'COUNT(m.comment) AS nbUnreadComment'],
      [],
      'm.seen = 1',
      ['m.user_id'],
      ''
    );
    return $this->getDatasClass();
  }
}
<?php

namespace App;

class Method {

  /* Affiche la semaine avec l'année / Displays the week with the year */
  public static function displayWeekYear(int $nbWeek): array
  {
    $weekYear = [
      'week' => date('W', strtotime('+' . $nbWeek . ' week')),
      'year' => date('Y', strtotime('+' . $nbWeek . ' week'))
    ];
    return $weekYear;
  }

  /* Affiche le lundi et dimanche d'une semaine / Displays the Monday and Sunday of a week */
  public static function displayDaysOfWeek(int $nbWeek): array
  {
    if (date('l') !== 'Monday') {
      $last = 'Last ';
    } else {
      $last = '';
    }
    
    $daysOfWeek = [
      'firstDay' => date('d m Y', strtotime($last . 'Monday +' . $nbWeek . ' Week')),
      'lastDay' => date('d m Y', strtotime('Sunday +' . $nbWeek . ' Week'))
    ];
    return $daysOfWeek;
  }

  /* Retourne une chaîne de caractère sans accents / Returns an unaccented string */
  public static function removeAccents(string $string): string
  {
    $accents = array(
        'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø',
        'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'
    );
    $replace = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N',
        'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y'
    );
    return strtr($string, array_combine($accents, $replace));
  }
}
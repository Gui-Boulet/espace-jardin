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
    $accents = [
        'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø',
        'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'
    ];
    $replace = [
        'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N',
        'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y'
    ];
    return strtr($string, array_combine($accents, $replace));
  }

  // Retourne un mot de passe généré aléatoirement - Returns a randomly generated password
  public static function generatePassword(): string
  {
    $lowercase = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 9, 2);
    $uppercase = substr(str_shuffle(strtoupper($lowercase)), 11, 2);
    $numbers = substr(str_shuffle('0123456789'), 6, 2);
    $specialChars = substr(str_shuffle('@#$&*_+-='), 3, 2);

    $passwordGenerate = str_shuffle($lowercase . $uppercase . $numbers . $specialChars);
    return $passwordGenerate;
  }

  // Retourne l'affichage formaté d'une date - Returns the formatted display of a date
  public static function displayDateFormat (array $interventionDate): string
  {
    $weekNumber = $interventionDate[1];
    if (strlen(strval($weekNumber)) < 2){
      $weekNumber = 0 . $weekNumber;
    }
    $formattedDate = 'Sem ' . $weekNumber . ' - ' . $interventionDate[0];

    $firstDay = date('d/m', strtotime($interventionDate[0] . 'W' . $weekNumber . '1'));
    $lastDay = date('d/m', strtotime($interventionDate[0] . 'W' . $weekNumber . '7'));
    
    $formattedDate .= ' (' . $firstDay . ' - ' . $lastDay . ')';

    return $formattedDate;
  }

  // Retourne la fréquence de renouvellement des services - Returns the frequency of service renewals
  public static function displayFrequency(string $service): string
  {
    if ($service === 'Elagage grands arbres' || $service === 'Elagage petits arbres' || 
        $service === 'Taille arbres fruitiers') {
      return '1 an';
    } elseif ($service === 'Taille haies' || $service === 'Taille arbustes') {
      return '4 mois';
    } elseif ($service === 'Tonte pelouse') {
      return '2 semaines';
    }
  }
}
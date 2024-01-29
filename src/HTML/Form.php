<?php

namespace App\HTML;

class Form {

  // Retourne un élément HTML input - Returns an HTML input element
  public function createInput(string $type, string $key, string $id, string $label, string $spacing): string
  {
    if ($type !== 'hidden'){
      return <<<HTML
        <div class="{$this->getSpacingClass($spacing)}">
          <input class="form-control" type="{$type}" name="{$key}" id="{$id}-{$key}" placeholder="{$label}" required>
          <label for="{$id}-{$key}">$label</label>
        </div>
HTML;
    } else {
      return <<<HTML
        <div class="{$this->getSpacingClass($spacing)}">
          <input class="form-control" type="{$type}" name="{$key}" id="{$id}-{$key}" placeholder="{$label}">
        </div>
HTML; 
    }
  }

  // Retourne un élément HTML textarea - Returns an HTML textarea element
  public function createTextarea(string $key, string $id, string $label, string $spacing): string
  {
    return <<<HTML
      <div class="{$this->getSpacingClass($spacing)}">
        <textarea class="form-control" name="{$key}" id="{$id}-{$key}" style="height: 100px"></textarea>
        <label for="{$id}-{$key}">$label</label>
      </div>
HTML;
  }

  // Retourne un élément HTML select - Returns an HTML select element
  public function createSelect(string $key, string $id, string $label, string $spacing, array $options): string
  {
    $result = <<<HTML
      <div class="{$this->getSpacingClass($spacing)}">
        <select name="{$key}" id="{$id}-{$key}" class="form-select">
HTML;
    foreach ($options as $option) {
      $result .= $this->createOption($option);
    }
    $result .= <<<HTML
        </select>
        <label for="{$id}-{$key}">$label</label>
      </div>
HTML;
    return $result;
  }

  // Retourne un élément HTML option - Returns an HTML option element
  private function createOption(string $value, ?string $selected = null): string
  {
    return <<<HTML
      <option value="{$value}" $selected>$value</option>
HTML;
  }

  // Retourne le contenu de l'attribut class d'une div - Returns the contents of the class attribute of a div
  private function getSpacingClass(string $spacing): string
  {
    $classDiv = 'form-floating';
    if (!empty($spacing)) {
      $classDiv .= ' ' . $spacing;
    }
    return $classDiv;
  }

  // Retourne un élément HTML small avec un message d'erreur - Returns an HTML small element with an error message
  public function displayErrorMessage(string $field, string $key, string $id): string
  {
    switch ($field) {
      case 'int5':
        $result = "Numéro de 5 chiffres (Donnée requise)";
        break;
      case 'int13':
        $result = "Numéro de 13 chiffres en commençant par 0033 (Donnée requise)";
        break;
      case 'int50':
        $result = "Nombre entre 0 et 50 (Donnée requise)";
        break;
      case 'int2000':
        $result = "Nombre entre 0 et 2000 (Donnée requise)";
        break;
      case 'intstr5':
        $result = "Nombre entre 1 et 9999, peut finir par une lettre (Donnée requise)";
        break;
      case 'str30':
        $result = "Entre 3 et 30 lettres (Donnée requise)";
        break;
      case 'strEmail':
        $result = "Entre 6 et 100 caractères | @ et . inclus (Donnée requise)";
        break;
      case 'str200':
        $result = "Entre 5 et 200 caractères (Donnée requise)";
        break;
      case 'strNotReq':
        $result = "Caractères <>/\\&;\" interdits et maximum 250";
        break;
      case 'strPassword':
        $result[] = "Entre 8 et 60 caractères (Donnée requise)";
        $result[] .= "1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial inclus";
        break;
      case 'login':
        $result = "Identifiant ou mot de passe incorrect";
        break;
    }
    
    $error = (is_array($result)) ? implode('<br>', $result) : $result;
    
    return <<<HTML
      <small class="invalid-feedback d-none" id="{$id}-{$key}-error">
        $error
      </small>
HTML;
  }
}
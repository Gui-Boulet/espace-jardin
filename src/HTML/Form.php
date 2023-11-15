<?php

namespace App\HTML;

class Form {

  private $errors;
  
  /*public function __construct(array $errors)
  {
    $this->errors = $errors;
  }*/

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
}
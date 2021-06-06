<?php

namespace Drupal\module_hero\Controller;

use Drupal\Core\Controller\ControllerBase;

class HeroController extends ControllerBase
{
  public function heroList() {
    $heros = [
      ['name' => 'Saravanan'],
      ['name' => 'Raja'],
      ['name' => 'Kumar'],
      ['name' => 'Selvam'],
      ['name' => 'Kannan'],
    ];

    $ourHeroes = '';
    foreach ($heros as $hero) {
      $ourHeroes .= '<li>' . $hero['name'] . '</li>';
    }
    return [
      '#title' => 'Our Heros List',
      '#type' => 'markup',
      '#markup' => '<ol>' . $ourHeroes . '</ol>'
    ];
  }
}

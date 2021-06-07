<?php

namespace Drupal\module_hero\OurHero;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class heroService
{
  /**
   * @var EntityTypeManager
   */
  private $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager)
  {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function getHeroList() {
    $heros = [
      ['name' => 'Bala'],
      ['name' => 'Raja'],
      ['name' => 'Kumar'],
      ['name' => 'Selvam'],
      ['name' => 'Kannan'],
    ];

    return $heros;
  }

  public function getArticleList() {
    $query = $this->entityTypeManager->getStorage('node')->getQuery();
    $articleNids = $query->condition('type', 'article')
      ->condition('status', 1)
      ->execute();
    return $this->entityTypeManager->getStorage('node')->loadMultiple($articleNids);
  }
}

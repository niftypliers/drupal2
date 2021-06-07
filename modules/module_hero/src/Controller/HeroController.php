<?php

namespace Drupal\module_hero\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\module_hero\OurHero\heroService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HeroController extends ControllerBase
{
  /**
   * @var heroService
   */
  private $heroService;

  public function __construct(heroService $heroService)
  {
    $this->heroService = $heroService;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container)
  {
    $heroContainer = $container->get('ourhero.list');
    return new static($heroContainer);
  }

  public function heroList()
  {
    $heros = $this->heroService->getHeroList();

    return [
      '#theme' => 'hero-list',
      '#items' => $heros,
      '#title' => $this->t('Our Heroes')
    ];
  }

  public function articleList() {
    $articles = $this->heroService->getArticleList();
    $nodeData = [];
    $i = 0;
    foreach ($articles as $node) {
      $nodeData[$i]['nid'] = $node->id();
      // $nodeData[$i]['title'] = $node->get('title')->getValue();
      // $nodeData[$i]['body'] = $node->get('body')->getValue();
      $i++;
    }
    // echo "<pre>"; print_r($nodeData); exit;
    // kint($nodeData); die();
    return [
      '#theme' => 'article-list',
      '#nodes' => $nodeData,
      '#title' => $this->t('My Articles')
    ];
  }
}

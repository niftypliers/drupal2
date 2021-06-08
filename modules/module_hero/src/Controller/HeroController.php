<?php

namespace Drupal\module_hero\Controller;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Controller\ControllerBase;
use Drupal\module_hero\OurHero\heroService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HeroController extends ControllerBase
{
  /**
   * @var heroService
   */
  private $heroService;
  protected $configService;

  public function __construct(heroService $heroService, ConfigFactory $configService)
  {
    $this->heroService = $heroService;
    $this->configService = $configService;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container)
  {
    $heroContainer = $container->get('ourhero.list');
    $configContainer = $container->get('config.factory');
    return new static($heroContainer, $configContainer);
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

  public function articleList()
  {
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
    // kint($this->configService); die();
    return [
      '#theme' => 'article-list',
      '#nodes' => $nodeData,
      '#title' => $this->configService->get('module_hero.heroconfig')->get('hero_page_title')
    ];
  }
}

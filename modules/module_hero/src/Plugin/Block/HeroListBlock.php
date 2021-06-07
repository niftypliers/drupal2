<?php

namespace Drupal\module_hero\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\module_hero\OurHero\heroService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'HeroListBlock' block.
 *
 * @Block(
 *  id = "hero_list_block",
 *  admin_label = @Translation("My Heros"),
 * )
 */
class HeroListBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * Drupal\module_hero\OurHero\heroService definition.
   *
   * @var \Drupal\module_hero\OurHero\heroService
   */
  protected $ourheroList;
  /**
   * @var heroService
   */
  private $heroService;
/*
  public function __construct(heroService $heroService)
  {
    $this->heroService = $heroService;
  }
*/
  public function __construct(heroService $heroService)
  {
    $this->heroService = $heroService;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static($container->get('ourhero.list'));
  }

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $heroes = $this->heroService->getHeroList();

    $build = [];
    $heroList = '';
    foreach ($heroes as $hero) {
      $heroList .= '<li>' . $hero['name'] . '</li>';
    }
    $build['#theme'] = 'hero_list_block';
    $build['hero_list_block']['#markup'] = '<ul>' . $heroList . '</ul>';

    return $build;
  }
}

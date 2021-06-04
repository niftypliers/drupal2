<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\dino_roar\Jurassic\RoarGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RoarController extends ControllerBase
{

  private $roarGenerator;
  private $logger;

  public function __construct(RoarGenerator $roarGenerator, LoggerChannelFactoryInterface $logger)
  {
    $this->roarGenerator = $roarGenerator;
    $this->logger = $logger;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container)
  {
    $roarGenerator = $container->get('dino_roar.roar_generator');
    $logger = $container->get('logger.factory');
    return new static($roarGenerator, $logger);
  }

  public function roar($count)
  {
    $roar = $this->roarGenerator->getRoar($count);
    $this->logger->get('default')->debug("Logging Roar with " . $count);
    return [
      '#title' => $roar
    ];
  }
}

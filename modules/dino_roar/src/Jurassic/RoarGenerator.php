<?php

namespace Drupal\dino_roar\Jurassic;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;

class RoarGenerator
{
  /**
   * @var KeyValueFactoryInterface
   */
  private $keyValueFactory;
  private $useCache;

  public function __construct(KeyValueFactoryInterface $keyValueFactory, $useCache)
  {
    $this->keyValueFactory = $keyValueFactory;
    $this->useCache = $useCache;
  }

  public function getRoar($length)
  {
    $store = $this->keyValueFactory->get('dino');
    $key = 'roar_'.$length;
    if($this->useCache && $store->has($key)) {
      return $store->get($key);
    }
    sleep(2);
    $string = "R" . str_repeat("o", $length) . "ar";
    if ($this->useCache) {
      $store->set($key, $string);
    }
    return $string;
  }
}

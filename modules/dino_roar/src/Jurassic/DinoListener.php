<?php


namespace Drupal\dino_roar\Jurassic;


use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DinoListener implements EventSubscriberInterface
{
  /**
   * @var LoggerChannelFactoryInterface
   */
  private $loggerChannelFactory;

  /**
   * DinoListener constructor.
   */
  public function __construct(LoggerChannelFactoryInterface $loggerChannelFactory)
  {
    $this->loggerChannelFactory = $loggerChannelFactory;
  }

  public function onKernelRequest(GetResponseEvent $event) {
    $request = $event->getRequest();
    $shouldRoar = $request->query->get('roar');

    if ($shouldRoar) {
      $this->loggerChannelFactory->get('default')->debug("The event is triggered for ROAAAR");
    }
  }

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::REQUEST => 'onKernelRequest',
    ];
  }
}

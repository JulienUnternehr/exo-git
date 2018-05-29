<?php

namespace Drupal\paragraphs;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Service Provider for Paragraphs.
 */
class ParagraphsServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $modules = $container->getParameter('container.modules');
    // Check for installed Replicate module.
    if (isset($modules['replicate']) ) {
      // Add a Replicate field event subscriber.
      $service_definition = new Definition(
        'Drupal\paragraphs\EventSubscriber\ReplicateFieldSubscriber',
        [new Reference('replicate.replicator')]
      );
      $service_definition->addTag('event_subscriber');
<<<<<<< HEAD
=======
      $service_definition->setPublic(TRUE);
>>>>>>> 96b1f22e793a1e1f305d8d92bf3bb96f3815c7d4
      $container->setDefinition('replicate.event_subscriber.paragraphs', $service_definition);
    }
  }
}

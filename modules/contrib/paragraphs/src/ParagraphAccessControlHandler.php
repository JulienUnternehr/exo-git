<?php

namespace Drupal\paragraphs;

<<<<<<< HEAD
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
=======
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityHandlerInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\DependencyInjection\ContainerInterface;
>>>>>>> 96b1f22e793a1e1f305d8d92bf3bb96f3815c7d4

/**
 * Access controller for the paragraphs entity.
 *
 * @see \Drupal\paragraphs\Entity\Paragraph.
 */
<<<<<<< HEAD
class ParagraphAccessControlHandler extends EntityAccessControlHandler {
=======
class ParagraphAccessControlHandler extends EntityAccessControlHandler implements EntityHandlerInterface {

  /**
   * Contains the configuration object factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a TranslatorAccessControlHandler object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config object factory.
   */
  public function __construct(EntityTypeInterface $entity_type, ConfigFactoryInterface $config_factory) {
    parent::__construct($entity_type);
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('config.factory')
    );
  }
>>>>>>> 96b1f22e793a1e1f305d8d92bf3bb96f3815c7d4

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $paragraph, $operation, AccountInterface $account) {
    // Allowed when the operation is not view or the status is true.
    /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
<<<<<<< HEAD
    $access_result = AccessResult::allowedIf($operation != 'view' || $paragraph->status->value);
=======
    $config = $this->configFactory->get('paragraphs.settings');
    if ($operation === 'view') {
      $access_result = AccessResult::allowedIf($paragraph->isPublished() || ($account->hasPermission('view unpublished paragraphs') && $config->get('show_unpublished')))->addCacheableDependency($config);
    }
    else {
      $access_result = AccessResult::allowed();
    }
>>>>>>> 96b1f22e793a1e1f305d8d92bf3bb96f3815c7d4
    if ($paragraph->getParentEntity() != NULL) {
      // Delete permission on the paragraph, should just depend on 'update'
      // access permissions on the parent.
      $operation = ($operation == 'delete') ? 'update' : $operation;
      // Library items have no support for parent entity access checking.
      if ($paragraph->getParentEntity()->getEntityTypeId() != 'paragraphs_library_item') {
        $parent_access = $paragraph->getParentEntity()->access($operation, $account, TRUE);
        $access_result = $access_result->andIf($parent_access);
      }
    }
    return $access_result;
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    // Allowed when nobody implements.
    return AccessResult::allowed();
  }

}

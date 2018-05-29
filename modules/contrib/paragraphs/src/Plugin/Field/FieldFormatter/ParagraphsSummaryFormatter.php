<?php

namespace Drupal\paragraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\ParagraphInterface;

/**
 * Plugin implementation of the 'paragraph_summary' formatter.
 *
 * @FieldFormatter(
 *   id = "paragraph_summary",
 *   label = @Translation("Paragraph summary"),
 *   field_types = {
 *     "entity_reference_revisions"
 *   }
 * )
 */
class ParagraphsSummaryFormatter extends EntityReferenceFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
      if ($entity->id()) {
<<<<<<< HEAD
        $elements[$delta] = [
          '#markup' => $entity->getSummary(),
        ];
      }
    }

=======
        $summary = $entity->getSummary();
        $elements[$delta] = [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['paragraph-formatter']
          ]
        ];
        $elements[$delta]['info'] = [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['paragraph-info']
          ]
        ];
        $elements[$delta]['info'] += $entity->getIcons();
        $elements[$delta]['summary'] = [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['paragraph-summary']
          ]
        ];
        $elements[$delta]['summary']['description'] = [
          '#markup' => $summary,
          '#prefix' => '<div class="paragraphs-collapsed-description">',
          '#suffix' => '</div>',
        ];
      }
    }
    $elements['#attached']['library'][] = 'paragraphs/drupal.paragraphs.formatter';
>>>>>>> 96b1f22e793a1e1f305d8d92bf3bb96f3815c7d4
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    $target_type = $field_definition->getSetting('target_type');
    $paragraph_type = \Drupal::entityTypeManager()->getDefinition($target_type);
    if ($paragraph_type) {
      return $paragraph_type->isSubclassOf(ParagraphInterface::class);
    }

    return FALSE;
  }
}

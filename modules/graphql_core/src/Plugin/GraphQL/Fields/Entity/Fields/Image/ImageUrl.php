<?php

namespace Drupal\graphql_core\Plugin\GraphQL\Fields\Entity\Fields\Image;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\image\Plugin\Field\FieldType\ImageItem;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the image url.
 *
 * @GraphQLField(
 *   id = "image_url",
 *   secure = true,
 *   name = "url",
 *   type = "String",
 *   field_types = {"image"},
 *   provider = "image",
 *   deriver = "Drupal\graphql_core\Plugin\Deriver\Fields\EntityFieldPropertyDeriver"
 * )
 */
class ImageUrl extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if ($value instanceof ImageItem && $value->entity->access('view')) {
      yield file_create_url($value->entity->getFileUri());
    }
  }

}

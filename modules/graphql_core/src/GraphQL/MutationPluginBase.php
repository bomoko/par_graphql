<?php

namespace Drupal\graphql_core\GraphQL;

use Drupal\graphql_core\GraphQL\Traits\ArgumentAwarePluginTrait;
use Drupal\graphql_core\GraphQL\Traits\NamedPluginTrait;
use Drupal\graphql_core\GraphQL\Traits\PluginTrait;
use Drupal\graphql_core\GraphQLPluginInterface;
use Drupal\graphql_core\GraphQLSchemaManagerInterface;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Field\AbstractField;

/**
 * Base class for graphql field plugins.
 */
abstract class MutationPluginBase extends AbstractField implements GraphQLPluginInterface {
  use PluginTrait;
  use NamedPluginTrait;
  use ArgumentAwarePluginTrait;

  /**
   * {@inheritdoc}
   */
  public function buildConfig(GraphQLSchemaManagerInterface $schemaManager) {
    $this->config = new FieldConfig([
      'name' => $this->buildName(),
      'type' => $this->buildType($schemaManager),
      'args' => $this->buildArguments($schemaManager),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return $this->config->getType();
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->buildName();
  }

  /**
   * {@inheritdoc}
   */
  public function build(FieldConfig $config) {
    // May be overridden, but not required any more.
  }

}
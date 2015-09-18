<?php

namespace Fenrizbes\YandexMapsFormTypeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fenrizbes_yandex_maps_form_type');

        $rootNode
            ->children()
                ->arrayNode('size')
                    ->addDefaultsIfNotSet()

                    ->children()
                        ->scalarNode('width')
                            ->cannotBeEmpty()
                            ->defaultValue(640)
                        ->end()

                        ->scalarNode('height')
                            ->cannotBeEmpty()
                            ->defaultValue(480)
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('default')
                    ->addDefaultsIfNotSet()

                    ->children()
                        ->scalarNode('lat')
                            ->cannotBeEmpty()
                            ->defaultValue(55.75319)
                        ->end()

                        ->scalarNode('lng')
                            ->cannotBeEmpty()
                            ->defaultValue(37.619953)
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('parameters')
                    ->addDefaultsIfNotSet()

                    ->children()
                        ->scalarNode('type')
                            ->cannotBeEmpty()
                            ->defaultValue('yandex#map')
                        ->end()

                        ->scalarNode('zoom')
                            ->cannotBeEmpty()
                            ->defaultValue(11)
                        ->end()

                        ->booleanNode('scrollZoom')
                            ->cannotBeEmpty()
                            ->defaultValue(false)
                        ->end()

                        ->arrayNode('controls')
                            ->prototype('scalar')->end()
                            ->cannotBeEmpty()
                            ->defaultValue(array('zoomControl'))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

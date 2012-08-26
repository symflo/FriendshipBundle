<?php

namespace Coo\FriendshipBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Configuration
 *
 * @author Cédric Dugat <ph3@slynett.com>
 * @author Florent Mondoloni
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('coo_friendship');

        $this->addSettingsSection($rootNode);
        $this->addRelationSection($rootNode);

        return $treeBuilder;
    }

    private function addSettingsSection(ArrayNodeDefinition $rootNode)
    {
        $bases = array('doctrine', 'redis');

        $rootNode
            ->children()
                ->arrayNode('settings')
                ->info('settings of Friendship')
                    ->children()
                        ->scalarNode('base')
                            ->validate()
                                ->ifNotInArray($bases)
                                ->thenInvalid('The %s is not supported. Please choose one of '.json_encode($bases))
                            ->end()
                            ->cannotBeOverwritten()
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('fallback')
                            ->validate()
                                ->ifNotInArray($bases)
                                ->thenInvalid('The %s is not supported. Please choose one of '.json_encode($bases))
                            ->end()
                            ->cannotBeOverwritten()
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addRelationSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('ships')
                    ->useAttributeAsKey('ship')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('entityFrom')->defaultValue(null)->end()
                            ->scalarNode('entityTo')->defaultValue(null)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}

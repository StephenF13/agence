<?php

namespace Ste\RecaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('recaptcha');
        // convention nom du bundle en snakecase en minuscule sans le mot bundle
        $rootNode->children()->scalarNode('key')->isRequired()->cannotBeEmpty()->end()->scalarNode('secret')->cannotBeEmpty()->isRequired()->end()->end();

        return $treeBuilder;
    }
}
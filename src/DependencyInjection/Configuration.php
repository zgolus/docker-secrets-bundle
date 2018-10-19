<?php

namespace Zgolus\DockerSecretsBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $treeBuilder->root('zgolus_docker_secrets');
        return $treeBuilder;
    }
}
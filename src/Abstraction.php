<?php

declare(strict_types=1);

/**
 * @package Oseille\ContainerBuilderBridge\PHPDI
 * @link    https://github.com/oseille/container-builder-bridge-php-di for the canonical source repository
 * @license https://github.com/oseille/container-builder-bridge-php-di/blob/master/LICENSE MIT
 */

namespace Oseille\ContainerBuilderBridge\PHPDI;

use Oseille\ContainerBuilderBridge\Abstraction as BridgeAbstraction;
use Psr\Container\ContainerInterface;

/**
 * League\Container builder abstraction.
 */
final class Abstraction extends BridgeAbstraction
{

    /**
     * Builds and returns the PSR-11 container.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function build(): ContainerInterface
    {
        return $this->pContainerBuilder->build();
    }

    /**
     * Add definitions to the container builder.
     *
     * A definition is a key value paired like:
     * [
     *  Acme\Foo::class => function (ContainerInterface $container) {...},
     *  Acme\Bar::class => function (ContainerInterface $container) {...},
     *  ...
     * ]
     *
     * @param array<int,array> $definitions,... The definitions.
     * @throws \InvalidArgumentException if $definitions is not an array
     * @return \Oseille\ContainerBuilderBridge\Abstraction
     */
    public function addDefinitions(...$definitions): BridgeAbstraction
    {
        $this->pContainerBuilder->addDefinitions(...$definitions);
        return $this;
    }
}

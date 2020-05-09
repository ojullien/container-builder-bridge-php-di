<?php

declare(strict_types=1);

/**
 * @package Oseille\ContainerBuilderBridge\PHPDI
 * @link    https://github.com/oseille/container-builder-bridge-php-di for the canonical source repository
 * @license https://github.com/oseille/container-builder-bridge-php-di/blob/master/LICENSE MIT
 */

namespace Oseille\ContainerBuilderBridge\PHPDI;

use DI\ContainerBuilder;
use Oseille\ContainerBuilderBridge\ImplementorInterface;
use Psr\Container\ContainerInterface;

/**
 *
 */
final class Implementor implements ImplementorInterface
{
    /**
     * PSR-11 Container.
     *
     * @var \DI\ContainerBuilder
     */
    private $pContainerBuilder;

    /**
     * Constructor.
     *
     * @param \DI\ContainerBuilder $pContainerBuilder
     */
    public function __construct(ContainerBuilder $pContainerBuilder)
    {
        $this->pContainerBuilder = $pContainerBuilder;
    }

    /**
     * Builds and returns the PSR-11 container.
     *
     * @return \DI\Container
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
     *
     * @throws \InvalidArgumentException if $definitions is not an array
     *
     * @return self
     */
    public function addDefinitions(...$definitions): ImplementorInterface
    {
        $this->pContainerBuilder->addDefinitions(...$definitions);
        return $this;
    }
}

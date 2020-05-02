<?php

declare(strict_types=1);

namespace OseilleTest\Utils;

use Oseille\ContainerBuilderBridge\ImplementorInterface;
use Psr\Container\ContainerInterface;

/**
 * An implementation of a PSR-11 container builder.
 */
class StubBuilder implements ImplementorInterface
{
    /**
     * Builds and returns the PSR-11 container.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function build(): ContainerInterface
    {
        return new StubContainer();
    }

    /**
     * Add definitions to the container.
     *
     * @param array $definitions The definitions.
     * @return \Oseille\ContainerBuilderBridge
     */
    public function addDefinitions(...$definitions): ImplementorInterface
    {
        return $this;
    }
}

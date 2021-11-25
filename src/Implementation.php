<?php

/**
 * @package OJullien\ContainerBuilderBridge\PHPDI
 * @link    https://github.com/ojullien/container-builder-bridge-php-di for the canonical source repository
 * @license https://github.com/ojullien/container-builder-bridge-php-di/blob/master/LICENSE MIT
 */

declare(strict_types=1);

namespace OJullien\ContainerBuilderBridge\PHPDI;

use DI\ContainerBuilder;
use OJullien\ContainerBuilderBridge\Definition\SequenceInterface;
use OJullien\ContainerBuilderBridge\ImplementationInterface;
use Psr\Container\ContainerInterface;

/**
 * This concreate Implementation corresponds to the PHP-DI builder.
 */
final class Implementation implements ImplementationInterface
{

    /**
     * Constructor.
     *
     * @param \DI\ContainerBuilder $builder
     */
    public function __construct(private ContainerBuilder $builder)
    {
    }

    /**
     * Builds and returns the PSR-11 container.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function build(): ContainerInterface
    {
        return $this->builder->build();
    }

    /**
     * Add definitions to the container.
     *
     * @param \OJullien\ContainerBuilderBridge\Definition\SequenceInterface ...$definitions
     * @return \OJullien\ContainerBuilderBridge\ImplementationInterface
     */
    public function setDefinitions(SequenceInterface ...$definitions): ImplementationInterface
    {
        /**
         * @var array<array-key,mixed>
         */
        $aDefinitions = [];
        foreach ($definitions as $sequence) {
            foreach ($sequence as $key => $value) {
                $aDefinitions[$key] = $value;
            }
        }
        $this->builder->addDefinitions($aDefinitions);
        return $this;
    }
}

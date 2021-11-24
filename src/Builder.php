<?php

/**
 * @package OJullien\ContainerBuilderBridge\PHPDI
 * @link    https://github.com/ojullien/container-builder-bridge-php-di for the canonical source repository
 * @license https://github.com/ojullien/container-builder-bridge-php-di/blob/master/LICENSE MIT
 */

declare(strict_types=1);

namespace OJullien\ContainerBuilderBridge\PHPDI;

use OJullien\ContainerBuilderBridge\AbstractBuilder;
use OJullien\ContainerBuilderBridge\Definition\SequenceInterface;
use Psr\Container\ContainerInterface;

/**
 * PSR-11 container builder class using PHP-DI
 */
final class Builder extends AbstractBuilder
{

    /**
     * Add definitions to the PHP-DI container builder.
     *
     * @param \OJullien\ContainerBuilderBridge\Definition\SequenceInterface ...$definitions
     * @return \Psr\Container\ContainerInterface
     */
    public function getContainer(SequenceInterface ...$definitions): ContainerInterface
    {
        return $this->pContainerBuilder->setDefinitions(...$definitions)->build();
    }
}

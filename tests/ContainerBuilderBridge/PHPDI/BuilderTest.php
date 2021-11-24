<?php

declare(strict_types=1);

namespace OJullienTest\ContainerBuilderBridge\PHPDI;

use OJullien\ContainerBuilderBridge\Definition\Sequence;
use OJullien\ContainerBuilderBridge\PHPDI\Builder;
use OJullienTest\Utils\ImplementationStub;

class BuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \OJullien\ContainerBuilderBridge\PHPDI\Builder
     * @uses \OJullien\ContainerBuilderBridge\AbstractBuilder
     * @group specification
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     */
    public function testGetContainer(): void
    {
        $pBuilder = new Builder(new ImplementationStub());
        $pContainer = $pBuilder->getContainer(Sequence::getSequence()->withDefinition('solo'));
        self::assertInstanceOf(\Psr\Container\ContainerInterface::class, $pContainer);
    }
}

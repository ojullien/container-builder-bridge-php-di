<?php

declare(strict_types=1);

namespace OseilleTest\ContainerBuilderBridge\PHPDI;

use Oseille\ContainerBuilderBridge\PHPDI\Abstraction;
use OseilleTest\Utils\StubBuilder;

class AbstractionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Oseille\ContainerBuilderBridge\PHPDI\Abstraction
     * @group specification
     */
    public function testBuild()
    {
        $pBuilder = new StubBuilder();
        $pBridge = new Abstraction($pBuilder);
        $pContainer = $pBridge->build();
        $this->assertInstanceOf('\Psr\Container\ContainerInterface', $pContainer);
    }

    /**
     * @covers \Oseille\ContainerBuilderBridge\PHPDI\Abstraction
     * @group specification
     */
    public function testAddDefinitions()
    {
        $pBuilder = new StubBuilder();
        $pBridge = new Abstraction($pBuilder);
        $this->assertInstanceOf('\Oseille\ContainerBuilderBridge\Abstraction', $pBridge->addDefinitions([]));
    }
}

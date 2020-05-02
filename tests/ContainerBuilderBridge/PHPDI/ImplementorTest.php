<?php

declare(strict_types=1);

namespace OseilleTest\ContainerBuilderBridge\PHPDI;

use DI\ContainerBuilder;
use Oseille\ContainerBuilderBridge\PHPDI\Implementor;

class ImplementorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Oseille\ContainerBuilderBridge\PHPDI\Implementor
     * @group specification
     */
    public function testImplementor()
    {
        $aDefinitions = [
            'factory_06' => static function (\Psr\Container\ContainerInterface $container): string {
                return 'I_am_factory_06';
            },
        ];
        $pBuilder = new ContainerBuilder();
        $pBuilder->useAutowiring(false);
        $pBuilder->useAnnotations(false);
        $pBridge = new Implementor($pBuilder);
        $pBridge->addDefinitions($aDefinitions);
        $pContainer = $pBridge->build();
        $this->assertInstanceOf('\Psr\Container\ContainerInterface', $pContainer);
        $this->assertTrue($pContainer->has('factory_06'), 'container has factory_06');
    }
}

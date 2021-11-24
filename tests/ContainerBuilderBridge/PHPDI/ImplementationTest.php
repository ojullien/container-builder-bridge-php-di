<?php

declare(strict_types=1);

namespace OjullienTest\ContainerBuilderBridge\PHPDI;

use DI\ContainerBuilder;
use OJullien\ContainerBuilderBridge\Definition\Sequence;
use OJullien\ContainerBuilderBridge\PHPDI\Implementation;
use Psr\Container\ContainerInterface;

class ImplementationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \OJullien\ContainerBuilderBridge\PHPDI\Implementation
     * @uses \OJullien\ContainerBuilderBridge\Definition\Sequence
     * @group specification
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws \InvalidArgumentException
     */
    public function testImplementation(): void
    {
        // Definition as Values
        $aDefinitionsAsValues = [
            'bob@example.com',
            'alice@example.com',
        ];
        $pSequenceAsValues = Sequence::getSequence()
            ->withDefinition('database.host', 'localhost')
            ->withDefinition('database.port', 5000)
            ->withDefinition('report.recipients', $aDefinitionsAsValues);
        self::assertCount(3, $pSequenceAsValues, 'Sequence as values count.');

        // Definition as Factories
        $pSequenceAsFactories = Sequence::getSequence()
            ->withDefinition(
                'factory',
                static function (ContainerInterface $container): string {
                    return 'connect ' . (string) $container->get('database.host') . ':' . (string) $container->get('database.port');
                }
            );
        self::assertCount(1, $pSequenceAsFactories, 'Sequence as factories count.');

        $pBuilder = new ContainerBuilder();
        $pBuilder->useAutowiring(false);
        $pBuilder->useAnnotations(false);
        $pImplementation = new Implementation($pBuilder);
        $pImplementation->setDefinitions($pSequenceAsValues, $pSequenceAsFactories);
        $pContainer = $pImplementation->build();
        self::assertInstanceOf(\Psr\Container\ContainerInterface::class, $pContainer);
        self::assertTrue($pContainer->has('database.host'), 'container has database.host');
        self::assertTrue($pContainer->has('database.port'), 'container has database.port');
        self::assertTrue($pContainer->has('report.recipients'), 'container has report.recipients');
        self::assertTrue($pContainer->has('factory'), 'container has factory');
        self::assertSame('connect localhost:5000', $pContainer->get('factory'), "Factory test");
    }
}

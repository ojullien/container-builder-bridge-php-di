<?php

declare(strict_types=1);

namespace OjullienTest\ContainerBuilderBridge\PHPDI;

use DI\ContainerBuilder;
use OJullien\ContainerBuilderBridge\Definition\Sequence;
use OJullien\ContainerBuilderBridge\PHPDI\Implementation;
use Psr\Container\ContainerInterface;
use function DI\create;

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

        // Definition as Objects
        //$pSequenceAsObjects = Sequence::getSequence()->withDefinition(\stdClass::class, create());

        $pBuilder = new ContainerBuilder();
        $pBuilder->useAutowiring(true);
        $pBuilder->useAnnotations(false);
        $pImplementation = new Implementation($pBuilder);
        $pImplementation->setDefinitions($pSequenceAsValues, $pSequenceAsFactories);
        $pContainer = $pImplementation->build();
        self::assertTrue($pContainer->has('database.host'), 'container has database.host');
        self::assertTrue($pContainer->has('database.port'), 'container has database.port');
        self::assertTrue($pContainer->has('report.recipients'), 'container has report.recipients');

        self::assertTrue($pContainer->has('factory'), 'container has factory');
        self::assertSame('connect localhost:5000', $pContainer->get('factory'), "Factory test");

        //$pObject1 = $pContainer->get(\stdClass::class);
        //self::assertInstanceOf(\stdClass::class, $pObject1);
        //$pObject2 = $pContainer->get(\stdClass::class);
        //self::assertNotSame($pObject1, $pObject2, 'Object are not the same');
    }
}

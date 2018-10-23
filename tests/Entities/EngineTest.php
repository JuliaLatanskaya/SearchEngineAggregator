<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Gatherer\Entities\Engine;
use \Gatherer\Service\GuzzleTransporter;

final class EngineTest extends TestCase
{
    private $engine;

    public function setUp()
    {
        $this->engine = new class extends Engine {
            public function getUri(): string
            {
                return "string";
            }

            public function search(string $keyword = ''): \Generator
            {
                foreach ([1, 2, 3] as $item) {
                    yield $item;
                }
            }
        };
    }

    public function testSetTransporter(): void
    {
        $transporter = $this->createMock(GuzzleTransporter::class);
        $this->engine->setTransporter($transporter);
        $this->assertAttributeInstanceOf(GuzzleTransporter::class, 'transporter', $this->engine);
    }

    public function testGetUri(): void
    {
        $this->assertInternalType('string', $this->engine->getUri());
    }

    public function testSearch(): void
    {
        $this->assertInstanceOf(Generator::class, $this->engine->search());
    }
}

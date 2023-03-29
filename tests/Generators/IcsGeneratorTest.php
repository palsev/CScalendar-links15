<?php

namespace Spatie\CalendarLinks\Tests\Generators;

use Spatie\CalendarLinks\Generator;
use Spatie\CalendarLinks\Generators\Ics;
use Spatie\CalendarLinks\Tests\TestCase;

class IcsGeneratorTest extends TestCase
{
    use GeneratorTestContract;

    /**
     * @param array $options @see \Spatie\CalendarLinks\Generators\Ics::__construct
     * @return \Spatie\CalendarLinks\Generator
     */
    protected function generator(array $options = []): Generator
    {
        // extend base class just to make output more readable and simplify reviewing of the snapshot diff
        return new class($options) extends Ics {
            protected function buildLink(array $propertiesAndComponents): string
            {
                return implode("\r\n", $propertiesAndComponents);
            }
        };
    }

    protected function linkMethodName(): string
    {
        return 'ics';
    }

    /** @test */
    public function it_can_generate_an_ics_link_with_custom_uid()
    {
        $this->assertMatchesSnapshot(
            $this->generator(['UID' => 'random-uid'])->generate($this->createShortEventLink())
        );
    }
}

<?php

declare(strict_types=1);

namespace Nikkoz\Text\Tests;

use Nikkoz\Text\LangCorrect;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Nikkoz\Text\LangCorrect
 */
class LangCorrectTest extends TestCase
{
    /**
     * @test
     * @dataProvider replaces()
     *
     * @param string $incorrect
     * @param string $expected
     * @param int    $mode
     */
    public function it_should_work(string $incorrect, string $expected, int $mode = LangCorrect::KEYBOARD_LAYOUT)
    {
        $lang = new LangCorrect();
        $result = $lang->parse($incorrect, LangCorrect::KEYBOARD_LAYOUT);

        self::assertEquals($expected, $result);
    }

    public function replaces(): array
    {
        return [
            ['ghbdtn', 'привет'],
            ['руддщ', 'hello'],
            [';tycrbq h.rpfr', 'женский рюкзак'],
        ];
    }

    /**
     * @test
     */
    public function it_should_skip_some(): void
    {
        $sut = new LangCorrect();
        $result = $sut->parse('блэкаут', LangCorrect::KEYBOARD_LAYOUT);

        self::assertEquals('блэкаут', $result);
    }
}

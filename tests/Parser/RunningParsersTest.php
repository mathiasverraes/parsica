<?php declare(strict_types=1);
/**
 * This file is part of the Parsica library.
 *
 * Copyright (c) 2020 Mathias Verraes <mathias@verraes.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Verraes\Parsica\Parser;

use Verraes\Parsica\Internal\Fail;
use PHPUnit\Framework\TestCase;
use function Verraes\Parsica\char;
use function Verraes\Parsica\skipSpace;
use function Verraes\Parsica\string;

final class RunningParsersTest extends TestCase
{
    /** @test */
    public function try_throws()
    {
        $parser = char('a');
        $result = $parser->try("a");
        $this->assertSame("a", $result->output());

        $this->expectException(Fail::class);
        $result = $parser->try("b");
    }

    /** @test */
    public function continueFrom()
    {
        $parser = string('hello')->sequence(skipSpace());
        $result = $parser->try("hello world!");
        $parser2 = string("world");
        $result2 = $parser2->continueFrom($result);
        $this->assertEquals("world", $result2->output());
        $this->assertEquals("!", $result2->remainder());
    }
}

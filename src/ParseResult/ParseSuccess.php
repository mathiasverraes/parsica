<?php declare(strict_types=1);

namespace Mathias\ParserCombinator\ParseResult;

use Mathias\ParserCombinator\ParseResult\ParseResult;
use Mathias\ParserCombinator\T;

/**
 * @template T
 */
final class ParseSuccess implements ParseResult
{
    /**
     * @var T
     */
    private $parsed;

    private string $remaining;

    /**
     * @param T $parsed
     */
    public function __construct($parsed, string $remaining)
    {
        $this->parsed = $parsed;
        $this->remaining = $remaining;
    }

    /**
     * @return T
     */
    public function parsed()
    {
        return $this->parsed;
    }

    public function remaining(): string
    {
        return $this->remaining;
    }

    public function isSuccess(): bool
    {
        return true;
    }

    public function isFail(): bool
    {
        return false;
    }

    public function expected(): string
    {
        throw new \Exception("Can't read the expectation of a succeeded ParseResult.");
    }

    public function got(): string
    {
        throw new \Exception("Can't read the expectation of a succeeded ParseResult.");
    }
}

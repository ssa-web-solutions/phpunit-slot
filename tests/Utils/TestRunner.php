<?php

namespace SSAWeb\PHPUnit\Tests\Utils;

use SSAWeb\PHPUnit\Tests\Utils\Dummy;

final class TestRunner {
    public function __construct(private readonly Dummy $dummy) {}

    public function run(string $parameter, bool $skip = false): void
    {
        if (!$skip) {
            $this->dummy->foo($parameter);
        }
    }
}
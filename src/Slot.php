<?php
namespace SSAWeb\PHPUnit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Callback;

/**
 * @property-read mixed $captured
 * @property-read bool $hasCaptured
 */
class Slot extends Assert {
    private mixed $value;
    private bool $hasCaptured = false;

    public function capture(): Callback
    {
        return $this->callback(
            function($value) {
                $this->hasCaptured = true;
                $this->value = $value;
                return true;
            }
        );
    }

    public function __get(string $value): mixed
    {
        return match($value) {
            'captured' => $this->value,
            'hasCaptured' => $this->hasCaptured,
            default => null
        };
    }
}
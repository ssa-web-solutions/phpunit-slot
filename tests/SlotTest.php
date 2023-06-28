<?php
namespace SSAWeb\PHPUnit\Tests;

use PHPUnit\Framework\TestCase;
use SSAWeb\PHPUnit\Slot;
use SSAWeb\PHPUnit\Tests\Utils\Dummy;
use SSAWeb\PHPUnit\Tests\Utils\TestRunner;

final class SlotTest extends TestCase {

    public function testShouldReturnTrueForHasCaptured() {
        $mock = $this->createMock(Dummy::class);
        $runner = new TestRunner($mock);
        $slot = new Slot();

        $mock->expects($this->once())->method('foo')->with($slot->capture());

        $runner->run('abc');

        $this->assertTrue($slot->hasCaptured);
    }

    public function testShouldReturnFalseWhenCaptureNotMade() {
        $mock = $this->createMock(Dummy::class);
        $runner = new TestRunner($mock);
        $slot = new Slot();

        $mock->expects($this->never())->method('foo')->with($slot->capture());

        $runner->run('abc', true);

        $this->assertFalse($slot->hasCaptured);
    }

    public function testShouldReturnCapturedValue() {
        $mock = $this->createMock(Dummy::class);
        $runner = new TestRunner($mock);
        $slot = new Slot();
        $parameter = 'abc';

        $mock
            ->expects($this->once())
            ->method('foo')
            ->with($slot->capture());

        $runner->run($parameter);
        
        $this->assertEquals($parameter, $slot->captured);
    }
}
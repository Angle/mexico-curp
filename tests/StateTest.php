<?php

namespace Angle\Mexico\CURP\Tests;

use Angle\Mexico\CURP\CURP;
use Angle\Mexico\CURP\State;
use PHPUnit\Framework\TestCase;

final class StateTest extends TestCase
{
    public function testCurpValidation(): void
    {
        $cases = [
            // input => expected output
            // valid strings
            'HEGG560427MVZRRL04'    => 'VER',
            'HEGG560427MNLRRL04'    => 'NLE',

            // invalid strings
            'HEGG560427MNLRRXXX'    => null,
        ];

        foreach ($cases as $input => $expected) {
            $this->assertEquals($expected, CURP::getStateIso($input));
        }
    }
}
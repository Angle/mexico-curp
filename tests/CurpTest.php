<?php

namespace Angle\Mexico\CURP\Tests;

use Angle\Mexico\CURP\CURP;
use PHPUnit\Framework\TestCase;

use DateTime;

final class CurpTest extends TestCase
{
    public function testCurpValidation(): void
    {
        $cases = [
            // input => expected output
            // valid strings
            'HEGG560427MVZRRL04'    => true,

            // invalid strings
            'invalid_curp'          => false,
            ''                      => false,
            'H22G560427MVZRRL04'    => false, // invalid digits in first 4 chars
            'HEGG560427XVZRRL04'    => false, // invalid 'gender' character 'X'
        ];

        foreach ($cases as $input => $expected) {
            $this->assertEquals($expected, CURP::isValid($input));
        }
    }

    public function testCurpBirthDate(): void
    {
        $cases = [
            // input => expected output
            // valid strings
            'HEGG560427MVZRRL04'    => new DateTime('1956-04-27 00:00:00'),

            // invalid strings
            'invalid_curp'          => null,
        ];

        foreach ($cases as $input => $expected) {
            $this->assertEquals($expected, CURP::getBirthDate($input));
        }
    }
}
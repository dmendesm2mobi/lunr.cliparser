<?php

/**
 * This file contains the LunrCliParserTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2013 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Shadow\Tests;

use Lunr\Shadow\LunrCliParser;
use Lunr\Halo\LunrBaseTest;
use ReflectionClass;

/**
 * This class contains common setup routines, providers
 * and shared attributes for testing the LunrCliParser class.
 *
 * @covers Lunr\Shadow\LunrCliParser
 */
abstract class LunrCliParserTest extends LunrBaseTest
{

    /**
     * Mock instance of the Console class.
     * @var Console
     */
    protected $console;

    /**
     * Test case constructor.
     */
    public function setUp(): void
    {
        $this->console = $this->getMockBuilder('Lunr\Shadow\Console')
                              ->disableOriginalConstructor()
                              ->getMock();

        $this->class      = new LunrCliParser($this->console, 'ab:c;d:;e::', [ 'first', 'second:', 'third;', 'fourth:;', 'fifth::' ]);
        $this->reflection = new ReflectionClass('Lunr\Shadow\LunrCliParser');
    }

    /**
     * Test case destructor.
     */
    public function tearDown(): void
    {
        unset($this->console);
        unset($this->class);
        unset($this->reflection);
    }

    /**
     * Unit test data provider for invalid parameters.
     *
     * @return array $params Array of invalid parameters
     */
    public function invalidParameterProvider(): array
    {
        $params   = [];
        $params[] = [ '-' ];
        $params[] = [ '--' ];

        return $params;
    }

    /**
     * Unit test data provider for valid parameters.
     *
     * @return array $params Array of valid parameters
     */
    public function validShortParameterProvider(): array
    {
        $params   = [];
        $params[] = [ 'a', [ 'test.php', '-a' ], [ 'a' => [] ] ];
        $params[] = [ 'a:', [ 'test.php', '-a', 'arg' ], [ 'a' => [ 'arg' ] ] ];
        $params[] = [ 'a::', [ 'test.php', '-a', 'arg1', 'arg2' ], [ 'a' => [ 'arg1', 'arg2' ] ] ];
        $params[] = [ 'a:::', [ 'test.php', '-a', 'arg1', 'arg2', 'arg3' ], [ 'a' => [ 'arg1', 'arg2', 'arg3' ] ] ];
        $params[] = [ 'b;', [ 'test.php', '-b', 'arg' ], [ 'b' => [ 'arg' ] ] ];
        $params[] = [ 'b;;', [ 'test.php', '-b', 'arg1', 'arg2' ], [ 'b' => [ 'arg1', 'arg2' ] ] ];
        $params[] = [ 'b;;;', [ 'test.php', '-b', 'arg1', 'arg2', 'arg3' ], [ 'b' => [ 'arg1', 'arg2', 'arg3' ] ] ];

        return $params;
    }

    /**
     * Unit test data provider for valid parameters.
     *
     * @return array $params Array of valid parameters
     */
    public function validLongParameterProvider(): array
    {
        $params   = [];
        $params[] = [ [ 'first' ], [ 'test.php', '--first' ], [ 'first' => [] ] ];
        $params[] = [ [ 'first:' ], [ 'test.php', '--first', 'arg' ], [ 'first' => [ 'arg' ] ] ];
        $params[] = [ [ 'first::' ], [ 'test.php', '--first', 'arg1', 'arg2' ], [ 'first' => [ 'arg1', 'arg2' ] ] ];
        $params[] = [ [ 'first:::' ], [ 'test.php', '--first', 'arg1', 'arg2', 'arg3' ], [ 'first' => [ 'arg1', 'arg2', 'arg3' ] ] ];
        $params[] = [ [ 'second;' ], [ 'test.php', '--second', 'arg' ], [ 'second' => [ 'arg' ] ] ];
        $params[] = [ [ 'second;;' ], [ 'test.php', '--second', 'arg1', 'arg2' ], [ 'second' => [ 'arg1', 'arg2' ] ] ];
        $params[] = [ [ 'second;;;' ], [ 'test.php', '--second', 'arg1', 'arg2', 'arg3' ], [ 'second' => [ 'arg1', 'arg2', 'arg3' ] ] ];

        return $params;
    }

}

?>

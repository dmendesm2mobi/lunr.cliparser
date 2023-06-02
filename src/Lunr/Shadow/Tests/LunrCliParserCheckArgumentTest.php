<?php

/**
 * This file contains the LunrCliParserCheckArgumentTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2013 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Shadow\Tests;

/**
 * This class contains test methods for check_arguments() in the LunrCliParser class.
 *
 * @covers Lunr\Shadow\LunrCliParser
 */
class LunrCliParserCheckArgumentTest extends LunrCliParserTest
{

    /**
     * Test that check_argument() returns FALSE for a valid parameter without arguments.
     *
     * @covers Lunr\Shadow\LunrCliParser::check_argument
     */
    public function testCheckArgumentReturnsFalseForValidParameterWithoutArgs(): void
    {
        $method = $this->get_accessible_reflection_method('check_argument');

        $value = $method->invokeArgs($this->class, [ 'a', 1, 0, 'a' ]);

        $this->assertFalse($value);
    }

    /**
     * Test that check_argument() returns TRUE for a superfluous argument.
     *
     * @covers Lunr\Shadow\LunrCliParser::check_argument
     */
    public function testCheckArgumentReturnsTrueForSuperfluousArgument(): void
    {
        $this->set_reflection_property_value('args', [ 'test.php', '-a', 'arg' ]);

        $method = $this->get_accessible_reflection_method('check_argument');

        $this->expectUserNotice('Superfluous argument: arg');

        $value = $method->invokeArgs($this->class, [ 'a', 1, 0, 'a' ]);

        $this->assertTrue($value);
    }

}

?>

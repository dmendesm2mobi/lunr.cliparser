<?php

/**
 * This file contains the LunrCliParserValidShortTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2013 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Shadow\Tests;

/**
 * This class contains test methods for is_valid_short() in the LunrCliParser class.
 *
 * @covers Lunr\Shadow\LunrCliParser
 */
class LunrCliParserValidShortTest extends LunrCliParserTest
{

    /**
     * Test that is_valid_short() returns FALSE for an invalid parameter.
     *
     * @param mixed $param Invalid Parameter
     *
     * @dataProvider invalidParameterProvider
     * @covers       Lunr\Shadow\LunrCliParser::is_valid_short
     */
    public function testIsValidShortReturnsFalseForInvalidParameter($param): void
    {
        $method = $this->get_accessible_reflection_method('is_valid_short');

        $this->expectUserWarning('Invalid parameter given: ' . $param);

        $value = $method->invokeArgs($this->class, [ $param, 1 ]);

        $this->assertFalse($value);
    }

    /**
     * Test that is_valid_short() sets error to TRUE for an invalid parameter.
     *
     * @param mixed $param Invalid Parameter
     *
     * @dataProvider invalidParameterProvider
     * @covers       Lunr\Shadow\LunrCliParser::is_valid_short
     */
    public function testIsValidShortSetsErrorTrueForInvalidParameter($param): void
    {
        $method = $this->get_accessible_reflection_method('is_valid_short');

        $this->expectUserWarning('Invalid parameter given: ' . $param);

        $method->invokeArgs($this->class, [ $param, 1 ]);

        $this->assertTrue($this->get_reflection_property_value('error'));
    }

    /**
     * Test that is_valid_short() adds a valid parameter to the ast array.
     *
     * @covers Lunr\Shadow\LunrCliParser::is_valid_short
     */
    public function testIsValidShortAddsValidParameterToAst(): void
    {
        $method = $this->get_accessible_reflection_method('is_valid_short');

        $this->set_reflection_property_value('short', 'a');

        $method->invokeArgs($this->class, [ 'a', 1 ]);

        $value = $this->get_reflection_property_value('ast');

        $this->assertArrayHasKey('a', $value);
        $this->assertEquals($value['a'], []);
    }

    /**
     * Test that is_valid_short() returns FALSE for a valid parameter without arguments.
     *
     * @depends Lunr\Shadow\Tests\LunrCliParserCheckArgumentTest::testCheckArgumentReturnsFalseForValidParameterWithoutArgs
     * @covers  Lunr\Shadow\LunrCliParser::is_valid_short
     */
    public function testIsValidShortReturnsFalseForValidParameterWithoutArguments(): void
    {
        $method = $this->get_accessible_reflection_method('is_valid_short');

        $this->set_reflection_property_value('short', 'a');

        $value = $method->invokeArgs($this->class, [ 'a', 1 ]);

        $this->assertFalse($value);
    }

    /**
     * Test that is_valid_short() returns TRUE for a valid parameter with arguments.
     *
     * @covers Lunr\Shadow\LunrCliParser::is_valid_short
     */
    public function testIsValidShortReturnsTrueForValidParameterWithArguments(): void
    {
        $method = $this->get_accessible_reflection_method('is_valid_short');

        $this->set_reflection_property_value('args', [ 'test.php', '-b', 'arg' ]);

        $this->set_reflection_property_value('short', 'b:');

        $value = $method->invokeArgs($this->class, [ 'b', 1 ]);

        $this->assertTrue($value);
    }

}

?>

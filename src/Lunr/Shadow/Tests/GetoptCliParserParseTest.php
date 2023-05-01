<?php

/**
 * This file contains the GetoptCliParserParseTest class.
 *
 * PHP Version 5.3
 *
 * @package    Lunr\Shadow
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @author     Andrea Nigido <andrea@m2mobi.com>
 * @copyright  2013-2017, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Shadow\Tests;

/**
 * This class contains test methods for parse() in the GetoptCliParser class.
 *
 * @covers Lunr\Shadow\GetoptCliParser
 */
class GetoptCliParserParseTest extends GetoptCliParserTest
{

    /**
     * Test that wrap_argument() replaces a FALSE value with an empty array.
     *
     * @covers Lunr\Shadow\GetoptCliParser::wrap_argument
     */
    public function testWrapArgumentReturnsEmptyArrayForFalse()
    {
        $method = $this->get_accessible_reflection_method('wrap_argument');

        $value = $method->invokeArgs($this->class, array(FALSE));

        $this->assertArrayEmpty($value);
    }

    /**
     * Test that wrap_argument() replaces a FALSE value with an empty array.
     *
     * @param mixed $cli_value Value to wrap
     *
     * @dataProvider valueProvider
     * @covers       Lunr\Shadow\GetoptCliParser::wrap_argument
     */
    public function testWrapArgumentReturnsValueWrappedInArray($cli_value)
    {
        $method = $this->get_accessible_reflection_method('wrap_argument');

        $value = $method->invokeArgs($this->class, array($cli_value));

        $this->assertEquals(array($cli_value), $value);
    }

    /**
     * Test that wrap_argument() does not re-wrap already wrapped arguments (like multiple parameters).
     *
     * @covers Lunr\Shadow\GetoptCliParser::wrap_argument
     */
    public function testWrapArgumentDoesNotRewrapArguments()
    {
        $method = $this->get_accessible_reflection_method('wrap_argument');

        $value = $method->invokeArgs($this->class, [ [ 'param1', 'param2' ] ]);

        $this->assertEquals([ 'param1', 'param2' ], $value);
    }

    /**
     * Test that parse() returns an empty array on error.
     *
     * @covers   Lunr\Shadow\GetoptCliParser::parse
     */
    public function testParseReturnsEmptyArrayOnError()
    {
        $this->mock_function('getopt', self::PARSE_FAILS);

        $value = $this->class->parse();

        $this->assertArrayEmpty($value);
        $this->unmock_function('getopt');
    }

    /**
     * Test that parse() sets error to TRUE on error.
     *
     * @covers   Lunr\Shadow\GetoptCliParser::parse
     */
    public function testParseSetsErrorTrueOnError()
    {
        $this->mock_function('getopt', self::PARSE_FAILS);

        $this->class->parse();

        $this->assertTrue($this->get_reflection_property_value('error'));
        $this->unmock_function('getopt');
    }

    /**
     * Test that parse() returns an ast array on success.
     *
     * @covers   Lunr\Shadow\GetoptCliParser::parse
     */
    public function testParseReturnsAstOnSuccess()
    {
        $this->mock_function('getopt', self::PARSE_WORKS);

        $value = $this->class->parse();

        $this->assertInternalType('array', $value);
        $this->assertEquals(array('a' => array(), 'b' => array('arg')), $value);
        $this->unmock_function('getopt');
    }

}

?>

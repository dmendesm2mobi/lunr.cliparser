<?php

/**
 * This file contains the GetoptCliParserTest class.
 *
 * PHP Version 5.3
 *
 * @category   Libraries
 * @package    Shadow
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Shadow\Tests;

use Lunr\Shadow\GetoptCliParser;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * This class contains common setup routines, providers
 * and shared attributes for testing the GetoptCliParser class.
 *
 * @category   Libraries
 * @package    Shadow
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Lunr\Shadow\GetoptCliParser
 */
abstract class GetoptCliParserTest extends PHPUnit_Framework_TestCase
{

    /**
     * Instance of the GetoptCliParser class.
     * @var GetoptCliParser
     */
    protected $class;

    /**
     * Reflection instance of the GetoptCliParser class.
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * Runkit simulation code for working getopt parsing.
     * @var string
     */
    const PARSE_WORKS = 'return array("a" => FALSE, "b" => "arg");';

    /**
     * Runkit simulation code for failing getopt parsing.
     * @var string
     */
    const PARSE_FAILS = 'return FALSE;';

    /**
     * Test case constructor.
     */
    public function setUp()
    {
        $this->class      = new GetoptCliParser('ab:c::', array('first', 'second:', 'third::'));
        $this->reflection = new ReflectionClass('Lunr\Shadow\GetoptCliParser');
    }

    /**
     * Test case destructor.
     */
    public function tearDown()
    {
        unset($this->class);
        unset($this->reflection);
    }

    /**
     * Unit test data provider for command line values.
     *
     * @return array $values Array of command line argument values.
     */
    public function valueProvider()
    {
        $values   = array();
        $values[] = array('string');
        $values[] = array(1);
        $values[] = array(1.1);
        $values[] = array(TRUE);
        $values[] = array(NULL);

        return $values;
    }

}

?>

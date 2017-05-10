<?php
/**
 * Created by PhpStorm.
 * User: chip
 * Date: 5/10/17
 * Time: 10:54 AM
 */

namespace Wasson_ECE\PHPEnum;
use PHPUnit\Framework\TestCase;
use Wasson_ECE\PHPEnum\Tests\TestEnum;
require_once __DIR__."/../vendor/autoload.php";

class BasicEnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestCase $testObj
     */
    private $testObj;

    public function testHas()
    {
        $this->assertTrue(TestEnum::isValid(0));
    }

    protected function setUp()
    {
        parent::setUp();
    }

}

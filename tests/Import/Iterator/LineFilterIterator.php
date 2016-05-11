<?php
/**
 * LineFilterIterator.php
 * @author: jmoulin@castelis.com
 */

namespace Tests\Import\Iterator;


class LineFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $config = $this->getMock(\FMUP\Import\Config::class, array('validateLine'));
        $config->method('validateLine')->willReturnOnConsecutiveCalls(true, false, true);
        $arrayForIterator = array('string', $config, null, false, $config, $config);
        $count = 0;
        foreach (new \FMUP\Import\Iterator\LineFilterIterator(new \ArrayIterator($arrayForIterator)) as $current) {
            $count++;
        }
        $this->assertSame(2, $count);
    }
}

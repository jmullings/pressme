<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

/**
 * Class FunctionalExamplesTest
 * basic function test for example response
 */
class FunctionalExamplesTest extends TestCase
{
    public function setUp()
    {
        if (defined('HHVM_VERSION')) $this->markTestSkipped('Not supported on HHVM (ignores window size / encoding format)');
    }
    public function testGzip()
    {

        chdir(__DIR__ . '/../examples');
        $out = unserialize(shell_exec('./gzip.php'));
        print_r($out);
        $this->assertEquals(preg_replace('/(\\.\\d+\\.)/', '.', $out['filename']) , 'text.txt');
    }

    public function testGunzip()
    {

        chdir(__DIR__ . '/../examples');//
        $out = unserialize(shell_exec('./gunzip.php'));
        print_r($out);
        $this->assertEquals($out['filename'] , 'text.txt');

    }

}

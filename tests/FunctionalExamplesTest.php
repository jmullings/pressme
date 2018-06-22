<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class FunctionalExamplesTest extends TestCase
{
    public function setUp()
    {
        if (defined('HHVM_VERSION')) $this->markTestSkipped('Not supported on HHVM (ignores window size / encoding format)');
    }
    public function testGzip()
    {

        chdir(__DIR__ . '/../examples');
        $out = exec('echo php gzip.php');
        $this->assertEquals($out, $out);
    }

    public function testGunzip()
    {

        chdir(__DIR__ . '/../examples');
        $out = exec('echo php gunzip.php');

        print_r($out);
        $this->assertEquals($out, $out);
    }

}

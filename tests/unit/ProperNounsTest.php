<?php

use Ricoa\CopyWritingCorrect\CopyWritingCorrectService;

class ProperNounsTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
        $service=new CopyWritingCorrectService();

        $this->assertEquals(
            '使用 GitHub 登录',
            $service->correct('使用github登录')
        );
    }
}

<?php

use Ricoa\CopyWritingCorrect\CopyWritingCorrectService;

class CharacterTest extends \PHPUnit_Framework_TestCase
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
            '这件蛋糕只卖 1000 元。',
            $service->correct('这件蛋糕只卖１０００元。')
        );

        $this->assertEquals(
            '乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」',
            $service->correct('乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」')
        );

        $this->assertEquals(
            '乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」！',
            $service->correct('乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」！！？？')
        );
    }
}

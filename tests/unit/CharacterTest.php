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

        //数字使用半角字符
        $this->assertEquals(
            '这件蛋糕只卖 1000 元。',
            $service->correct('这件蛋糕只卖１０００元。')
        );

        //使用全角中文标点
        $this->assertEquals(
            '乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」',
            $service->correct('乔布斯那句话是怎么说的?「Stay hungry, stay foolish.」')
        );

        //去除中文标点重复
        $this->assertEquals(
            '乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」！',
            $service->correct('乔布斯那句话是怎么说的？「Stay hungry, stay foolish.」！！？？')
        );

    }
}

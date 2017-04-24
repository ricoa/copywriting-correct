<?php

use Ricoa\CopyWritingCorrect\CopyWritingCorrectService;

/**
 * 检测 CJK和半角字符之间增加空格
 *
 * Class SpaceBetweenCjkAndEngTest
 */
class SpaceTest extends \PHPUnit_Framework_TestCase
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

        //CJK 与英文
        $this->assertEquals(
            '在 LeanCloud 上，数据存储是围绕 AVObject 进行的。每个 AVObject 都包含了与 JSON 兼容的 key-value 对应的数据。数据是 schema-free 的，你不需要在每个 AVObject 上提前指定存在哪些键，只要直接设定对应的 key-value 即可。',
            $service->correct('在LeanCloud上，数据存储是围绕AVObject进行的。每个AVObject都包含了与JSON兼容的key-value对应的数据。数据是schema-free的，你不需要在每个AVObject上提前指定存在哪些键，只要直接设定对应的key-value即可。')
        );

        //CJK 与数字
        $this->assertEquals(
            '今天出去买菜花了 5000 元。',
            $service->correct('今天出去买菜花了5000元。')
        );

        //数字与英文单位之间
        $this->assertEquals(
            '我家的光纤入户宽带有 10 Gbps，SSD 一共有 20 TB。',
            $service->correct('我家的光纤入户宽带有10Gbps，SSD一共有20TB。')
        );
    }
}

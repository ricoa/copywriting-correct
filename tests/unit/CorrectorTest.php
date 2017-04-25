<?php
use Ricoa\CopyWritingCorrect\CopyWritingCorrectService;

/**
 * 纠正器注入、重置功能
 * Class CorrectorTest
 */
class CorrectorTest extends \PHPUnit_Framework_TestCase
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

        $correctors=[new class extends \Ricoa\CopyWritingCorrect\Correctors\Corrector{
            protected static $corrector=null;
            /**
             * @param string $text
             *
             * @return mixed
             */
            public function handle($text)
            {
                return $text;
            }
        }];
        $service->addCorrectors($correctors);//注入纠正器

        $this->assertEquals(
            '使用 GitHub 登录',
            $service->correct('使用github登录')
        );

        $service->resetCorrectors($correctors);//重置纠正器，也即废弃默认的纠正器

        $this->assertEquals(
            '使用github登录',
            $service->correct('使用github登录')
        );
    }
}

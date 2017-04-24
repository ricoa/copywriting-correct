<?php

namespace Ricoa\CopyWritingCorrect\Correctors;

/**
 *
 * 把数字和英文、部分标点符号等全角字符转换为半角字符
 *
 * @package Ricoa\CopyWritingCorrect\Correctors
 */
class CharacterCorrector extends Corrector {

    /**
     * @var Corrector|null
     */
    protected static $corrector=null;

    /**
     * @param string $text
     *
     * @return mixed
     */
    public function handle($text)
    {
        //全角转半角
        $text= str_replace(getDBC(),getSBC(),$text);

        //中文后使用全角中文标点
        $text = preg_replace_callback("/([".getCJK().'])([!?\.,\(\):;\'\"])/iu', function($m){
            $replace=[
                '!'=>'！',
                '?'=>'？',
                '.'=>'。',
                ','=>'，',
                '('=>'（',
                ')'=>'）',
                ':'=>'：',
                ';'=>'；',
            ];
            return $m[1].$replace[$m[2]];
        }, $text);


        //去除中文标点重复
        $text = preg_replace("/([！？])([！？]*)/iu", '$1', $text);

        return $text;
    }
}
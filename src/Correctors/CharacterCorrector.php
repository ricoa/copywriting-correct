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
        $text= str_replace(getDBC(),getSBC(),$text);

        $text = preg_replace("/([！？])([！？]*)/iu", '$1', $text);

        return $text;
    }
}
<?php

namespace Ricoa\CopyWritingCorrect\Correctors;

/**
 *
 * 在中文字符与英文字符间添加空格
 *
 *update base on https://github.com/Rakume/pangu.php/blob/fc7d1c54ada1c85bb0e2725d41ce41b449eb3737/pangu.php
 *
 * @package Ricoa\CopyWritingCorrect\Correctors
 */
class SpaceCorrector extends Corrector{

    /**
     * @var Corrector|null
     */
    protected static $corrector=null;

    /**
     * @var array
     */
    protected $patterns=[];


    /**
     * SpaceCorrector constructor.
     */
    protected function __construct()
    {
        $cn = getCN();
        $this->patterns = array(
            'cn_quote' => array(
                '([' . $cn . '])(["\'])',
                '$1 $2'
            ),

            'quote_cn' => array(
                '(["\'])([' . $cn . '])',
                '$1 $2'
            ),

            'fix_quote' => array(
                '(["\']+)(\s*)(.+?)(\s*)(["\']+)',
                '$1$3$5'
            ),

            'cn_hash' => array(
                '([' . $cn . '])(#(\S+))',
                '$1 $2'
            ),

            'hash_cn' => array(
                '((\S+)#)([' . $cn . '])',
                '$1 $3'
            ),

            'cn_operator_ans' => array(
                '([' . $cn . '])([A-Za-z0-9])([\+\-\*\/=&\\|<>])',
                '$1 $2 $3'
            ),

            'ans_operator_cn' => array(
                '([\+\-\*\/=&\\|<>])([A-Za-z0-9])([' . $cn . '])',
                '$1 $2 $3'
            ),

            'bracket' => array(
                array(
                    '([' . $cn . '])([<\[\{\(]+(.*?)[>\]\}\)]+)([' . $cn . '])',
                    '$1 $2 $4'
                ),

                array(
                    'cn_bracket' => array(
                        '([' . $cn . '])([<>\[\]\{\}\(\)])',
                        '$1 $2'
                    ),

                    'bracket_cn' => array(
                        '([<>\[\]\{\}\(\)])([' . $cn . '])',
                        '$1 $2'
                    )
                )
            ),

            'fix_bracket' => array(
                '([<\[\{\(]+)(\s*)(.+?)(\s*)([>\]\}\)]+)',
                '$1$3$5'
            ),

            'cn_ans' => array(
                '([' . $cn . '])([A-Za-z0-9`@&%\=\$\^\*\-\+\\/|\\\])',
                '$1 $2'
            ),

            'ans_cn' => array(
                '([A-Za-z0-9`~!%&=;\|\,\.\:\?\$\^\*\-\+\/\\\])([' . $cn . '])',
                '$1 $2'
            ),
            'number_letters'=>array(
                '([0-9])([A-Za-z])',
                '$1 $2'
            ),
            'full_character'=>array(
                "([ ]*)([\u{FF00}-\u{FFFF}。])([ ]*)",
                '$2'
            ),
            'cn_greek'=>array(
                '([' . $cn . '0-9A-Za-z])([\p{Greek}])',
                '$1 $2'
            ),
            'greek_cn'=>array(
                '([\p{Greek}])([' . $cn . '0-9A-Za-z])',
                '$1 $2'
            ),
        );
    }

    /**
     * @param string $text
     *
     * @return mixed
     */
    public function handle($text)
    {
        foreach ($this->patterns as $key => $value) {
            if ($key === 'bracket') {
                $old = $text;
                $new = preg_replace('/' . $value[0][0] . '/iu', $value[0][1], $text);
                $text = $new;

                if ($old === $new) {
                    foreach ($value[1] as $val) {
                        $text = preg_replace('/' . $val[0] . '/iu', $val[1], $text);
                    }
                }

                continue;
            }

            $text = preg_replace('/' . $value[0] . '/iu', $value[1], $text);
        }

        return $text;
    }
}

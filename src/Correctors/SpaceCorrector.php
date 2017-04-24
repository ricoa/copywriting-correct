<?php

namespace Ricoa\CopyWritingCorrect\Correctors;

/**
 *
 * 在 CJK 字符与英文字符间添加空格
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
        $cjk = getCJK();
        $this->patterns = array(
            'cjk_quote' => array(
                '([' . $cjk . '])(["\'])',
                '$1 $2'
            ),

            'quote_cjk' => array(
                '(["\'])([' . $cjk . '])',
                '$1 $2'
            ),

            'fix_quote' => array(
                '(["\']+)(\s*)(.+?)(\s*)(["\']+)',
                '$1$3$5'
            ),

            'cjk_hash' => array(
                '([' . $cjk . '])(#(\S+))',
                '$1 $2'
            ),

            'hash_cjk' => array(
                '((\S+)#)([' . $cjk . '])',
                '$1 $3'
            ),

            'cjk_operator_ans' => array(
                '([' . $cjk . '])([A-Za-z0-9])([\+\-\*\/=&\\|<>])',
                '$1 $2 $3'
            ),

            'ans_operator_cjk' => array(
                '([\+\-\*\/=&\\|<>])([A-Za-z0-9])([' . $cjk . '])',
                '$1 $2 $3'
            ),

            'bracket' => array(
                array(
                    '([' . $cjk . '])([<\[\{\(]+(.*?)[>\]\}\)]+)([' . $cjk . '])',
                    '$1 $2 $4'
                ),

                array(
                    'cjk_bracket' => array(
                        '([' . $cjk . '])([<>\[\]\{\}\(\)])',
                        '$1 $2'
                    ),

                    'bracket_cjk' => array(
                        '([<>\[\]\{\}\(\)])([' . $cjk . '])',
                        '$1 $2'
                    )
                )
            ),

            'fix_bracket' => array(
                '([<\[\{\(]+)(\s*)(.+?)(\s*)([>\]\}\)]+)',
                '$1$3$5'
            ),

            'cjk_ans' => array(
                '([' . $cjk . '])([A-Za-z0-9`@&%\=\$\^\*\-\+\\/|\\\])',
                '$1 $2'
            ),

            'ans_cjk' => array(
                '([A-Za-z0-9`~!%&=;\|\,\.\:\?\$\^\*\-\+\/\\\])([' . $cjk . '])',
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
            'cjk_greek'=>array(
                '([' . $cjk . '0-9A-Za-z])([\p{Greek}])',
                '$1 $2'
            ),
            'greek_cjk'=>array(
                '([\p{Greek}])([' . $cjk . '0-9A-Za-z])',
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
                    foreach ($value[1] as $value) {
                        $text = preg_replace('/' . $value[0] . '/iu', $value[1], $text);
                    }
                }

                continue;
            }

            $text = preg_replace('/' . $value[0] . '/iu', $value[1], $text);
        }

        return $text;
    }
}
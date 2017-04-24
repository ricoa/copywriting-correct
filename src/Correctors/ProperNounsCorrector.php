<?php

namespace Ricoa\CopyWritingCorrect\Correctors;

use Naux\AutoCorrect;

/**
 *
 * 纠正专有名词
 *
 * @package Ricoa\CopyWritingCorrect\Correctors
 */
class ProperNounsCorrector extends Corrector {

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
        $correct = new AutoCorrect;

        return $correct->convert($text);
    }
}
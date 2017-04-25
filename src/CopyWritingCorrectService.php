<?php

namespace Ricoa\CopyWritingCorrect;

use Ricoa\CopyWritingCorrect\Correctors\CharacterCorrector;
use Ricoa\CopyWritingCorrect\Correctors\ProperNounsCorrector;
use Ricoa\CopyWritingCorrect\Correctors\SpaceCorrector;

class CopyWritingCorrectService{

	protected $corrects=[
        ProperNounsCorrector::class,
        CharacterCorrector::class,
        SpaceCorrector::class,
    ];


    /**
     * @param array $corrects
     */
    public function resetCorrectors(array $corrects)
    {
        $this->corrects=$corrects;
    }

    /**
     * @param array $corrects
     */
    public function addCorrectors(array $corrects)
    {
        $this->corrects=array_merge($this->corrects,$corrects);
	}

    /**
     * @param $text
     *
     * @return mixed
     */
    public function correct($text)
    {
        foreach($this->corrects as $corrects){
            $text=$corrects::getInstance()->handle($text);
        }

        return $text;
	}
}
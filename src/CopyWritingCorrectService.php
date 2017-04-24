<?php

namespace Ricoa\CopyWritingCorrect;

use Ricoa\CopyWritingCorrect\Correctors\SpaceCorrector;

class CopyWritingCorrectService{

	protected $defaultCorrect=[
        SpaceCorrector::class,
    ];
	
	public function __construct()
	{
	    
	}
}
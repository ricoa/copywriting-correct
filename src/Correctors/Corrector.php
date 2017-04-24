<?php
namespace Ricoa\CopyWritingCorrect\Correctors;
use \Ricoa\CopyWritingCorrect\Correctors\Interfaces\ICorrector;

abstract class Corrector implements ICorrector {
    /**
     * @var SpaceCorrector|null
     */
    protected static $corrector=null;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if(static::$corrector==null){
            static::$corrector=new static();
        }

        return static::$corrector;
    }

}
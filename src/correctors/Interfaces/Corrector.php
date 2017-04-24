<?php

namespace Ricoa\CopyWritingCorrect\Correctors\Interfaces;

interface Corrector
{

    /**
     * @return mixed
     */
    public static function getInstance();

    /**
     * @param string $text
     *
     * @return mixed|void
     */
    public function handle($text);
}
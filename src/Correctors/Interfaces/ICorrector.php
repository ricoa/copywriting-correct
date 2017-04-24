<?php

namespace Ricoa\CopyWritingCorrect\Correctors\Interfaces;

interface ICorrector
{

    /**
     * @param string $text
     *
     * @return mixed|void
     */
    public function handle($text);
}
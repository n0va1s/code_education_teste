<?php

namespace JP\Sistema;

class Math
{
    public function somar($x, $y)
    {
        if (!is_numeric($x) or !is_numeric($y)) {
            throw new \InvalidArgumentException("X ou Y não é numérico", 1);
        }
        return $x + $y;
    }
}

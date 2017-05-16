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

    public function converterRomano($valor)
    {
        if (!is_numeric($valor)) {
            throw new \InvalidArgumentException("O valor informado não é numérico", 1);
        }
        $dados = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $conversao = null;
        while ($valor > 0) {
            foreach ($dados as $rom => $ara) {
                if ($valor >= $ara) {
                    $valor -= $ara;
                    $conversao .= $rom;
                    break;
                }
            }
        }
        return $conversao;
    }
}

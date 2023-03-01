<?php

namespace App\Operations;

class Operation
{
    private float $val1;
    private float $val2;
    private string $op;

    /**
     * @return float
     */
    public function getVal1(): float
    {
        return $this->val1;
    }

    /**
     * @param float $val1
     */
    public function setVal1(float $val1): void
    {
        $this->val1 = $val1;
    }

    /**
     * @return float
     */
    public function getVal2(): float
    {
        return $this->val2;
    }

    /**
     * @param float $val2
     */
    public function setVal2(float $val2): void
    {
        $this->val2 = $val2;
    }

    /**
     * @return string
     */
    public function getOp(): string
    {
        return $this->op;
    }

    /**
     * @param string $op
     */
    public function setOp(string $op): void
    {
        $this->op = $op;
    }
}
?>
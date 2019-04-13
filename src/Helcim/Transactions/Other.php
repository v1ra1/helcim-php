<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Transactions_Other
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    public function getData()
    {
        return $this->xml;
    }
}
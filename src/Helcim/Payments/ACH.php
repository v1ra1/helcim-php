<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */
class Helcim_Payments_ACH
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
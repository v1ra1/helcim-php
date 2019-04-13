<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */

class Helcim_Payments
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;

        $this->card = new Helcim_Payments_Card($master);
        $this->ach = new Helcim_Payments_ACH($master);
        $this->misc = new Helcim_Payments_Misc($master);
    }

    public function getData()
    {
        return $this->xml;
    }
}
<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Transactions
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;

        $this->card = new Helcim_Transactions_Card($master);
        $this->ach = new Helcim_Transactions_ACH($master);
        $this->other = new Helcim_Transactions_Other($master);
    }

    /**
     * @reference https://www.helcim.com/support/article/689-helcim-commerce-api-list-terminals/
     *
     * @return $this
     */
    public function listTerminals($params = array())
    {
        $this->xml = $this->master->call('terminalSearch', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}
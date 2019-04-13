<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Misc
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/691-helcim-commerce-api-testing-the-connection/
     *
     * @return $this
     */
    public function testConnection($params = array())
    {
        $this->xml = $this->master->call('connectionTest', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/692-helcim-commerce-api-get-account-information/
     *
     * @return $this
     */
    public function getAccountInformation($params = array())
    {
        $this->xml = $this->master->call('accountInfo', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }

}
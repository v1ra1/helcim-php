<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Settings
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/687-helcim-commerce-api-inventory-settings/
     *
     * @return $this
     */
    public function inventorySettings($params = array())
    {
        $this->xml = $this->master->call('inventorySettings', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/688-helcim-commerce-api-pointofsale-settings/
     *
     * @return $this
     */
    public function pointOfSaleSettings($params = array())
    {
        $this->xml = $this->master->call('posSettings', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/690-helcim-commerce-api-pointofsale-layouts/
     *
     * @return $this
     */
    public function pointOfSaleLayouts($params = array())
    {
        $this->xml = $this->master->call('poslayoutsView', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }

}
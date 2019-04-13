<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Orders
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/656-helcim-commerce-api-view-an-order/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  orderNumber	            String	    Yes	        The order number.
     *
     * @return $this
     */
    public function viewOrder($orderNumber, $params = array())
    {
        $required_array = array(
            'orderNumber' => $orderNumber
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('orderView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/657-helcim-commerce-api-add-or-edit-an-order/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  orderNumber	            String	    No	        The order number. If it's entered then you are editing an order. If it is not entered then you are adding a new order.
        dateIssed	            String	    No	        The date the order was issued.
        datePaid	            String	    No	        The date the order was paid.
        currency	            String	    No	        The currency of the order's price.
        status	                String	    No	        Due, paid, shipped, completed, refunded, cancelled.
        paymentTerms	        Integer	    No	        The number of days the customer has to pay for the order.
        comments	            String	    No	        Comments about the order.
        customerCode	        String	    No	        The customer code.
        billing_contactName	    String	    No	        The the billing address contact name.
        billing_businessName	String	    No	        The billing address business name.
        billing_street1	        String	    No	        The billing street address.
        billing_street2	        String	    No	        The billing street address.
        billing_city	        String	    No	        The billing city.
        billing_province	    String	    No	        The billing province.
        billing_country	        String	    No	        The billing country.
        billing_postalCode	    String 	    No	        The billing postal code.
        billing_phone	        String	    No	        The billing phone number.
        billing_fax	            String	    No	        The billing fax number
        billing_email	        String 	    No	        The billing email.
        shipping_contactName	String	    No	        The shipping contact name.
        shipping_businessName	String	    No	        The shipping business name.
        shipping_street1	    String	    No	        The shipping street address.
        shipping_street2	    String	    No	        The shipping street address.
        shipping_city	        String	    No 	        The shipping city.
        shipping_province	    String	    No	        The shipping province.
        shipping_country	    String	    No	        The shipping country.
        shipping_postalCode	    String	    No	        The shipping postal code.
        shipping_phone	        String	    No	        The shipping phone number.
        shipping_fax	        String	    No	        The shipping fax number.
        shipping_email	        String	    No	        The shipping email address.
        amount	                Decimal	    No	        Amount to process. Must include two decimal places, and must NOT include $.
        amountShipping	        Decimal	    No	        The shipping cost.
        amountTax	            Decimal	    No	        The tax.
        amountTip	            Decimal	    No	        The tip.
        amountDiscount	        Decimal	    No	        The discount.
        shippingMethod	        String	    No	        The method of shipping.
        taxDetails	            String 	    No	        Information about the applicable taxes.
        discountDetails	        String	    No	        Information about the applicable discounts.
        Order Information
        NOTICE: For all item variables replace "#" with a unique item number (starting at 1, and increasing by 1 for each unique item added).
        itemSKU#	            Integer	    No	        The sku.
        itemDescription#	    String	    No	        The item description.
        itemSerialNumber#	    String	    No	        The item serial number.
        itemQuantity#	        Decimal	    No	        Item quantity, must be at least one for item to be added.
        itemPrice#	            Decimal	    No	        The item price.
        itemTotal#	            Decimal	    No	        The item price x the quantity.
     *
     * @return $this
     */
    public function addOrEditOrder($params = array())
    {
        $this->xml = $this->master->call('orderEdit', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/658-helcim-commerce-api-list-orders/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode	        String	    No	        The customer code.
     *
     * @return $this
     */
    public function listOrders($params = array())
    {
        $this->xml = $this->master->call('orderSearch', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/659-helcim-commerce-api-send-an-order-receipt/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  emailAddress	        String	    Yes	        The recepients email address.
        orderNumber	            String	    Yes	        The order number.
     *
     * @return $this
     */
    public function sendOrderReceipt($emailAddress, $orderNumber, $params = array())
    {
        $required_array = array(
            'emailAddress' => $emailAddress,
            'orderNumber' => $orderNumber
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('orderEmailReceipt', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/660-helcim-commerce-api-create-an-order-pdf/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  orderNumber	            String	    Yes	        The order number.
     *
     * @return $this
     */
    public function createOrderPDF($orderNumber, $params = array())
    {
        $required_array = array(
            'orderNumber' => $orderNumber
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('orderPDFReceipt', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}
<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */

class Helcim_Payments_Card
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /*
     *  @reference https://www.helcim.com/support/article/706-helcim-commerce-api-purchase-sale/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  amount	                Decimal	    Yes	        The amount of the transaction.
        cardHolderName	        String	    No	        The cardholder names.
        cardNumber	            Integer	    Yes	        The credit card number.
        cardExpiry	            Integer	    Yes	        The credit card expiration date
        cardCVV	                Integer	    Yes	        The credit card CVV (digits on back of credit card).
        cardHolderAddress	    String	    No	        The card holder's address.
        cardHolderPostalCode	String	    No	        The card holder's postal code.
        ecommerce	            Integer	    No	        Set to 1 to indicate that the transaction is e-commerce. If enabled, the Helcim Fraud Defender will provide further analysis.
        ipAddress	            String	    No	        IP Address of the customer making the transaction

        @return $this
     */
    public function purchase($amount, $cardNumber, $cardExpiry, $cardCVV, $params = array())
    {
        $required_array = array(
            'amount' => $amount,
            'cardNumber' => $cardNumber,
            'cardExpiry' => $cardExpiry,
            'cardCVV' => $cardCVV
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

        $this->xml = $this->master->call('purchase', $params, true);
        return $this;
    }

    /*
     *  @reference https://www.helcim.com/support/article/707-helcim-commerce-api-purchase-using-card-token/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode            String	    Yes	        The customer code.
        orderNumber             String	    No	        The order number.
        cardToken               String	    Yes	        The credit card token.
        cardF4L4                Integer	    Yes	        The credit card first 4 and last 4 digits.
        cardF4L4Skip	        Integer	    Yes     	Set to "1" if you wish to skip the first-4 last-4 digit verification process. Not recommended.
        amount	                Decimal	    Yes	        The transaction amount.
        comments	            String	    No	        Optional comments.

        @return $this
     */
    public function purchaseWithToken($amount, $customerCode, $cardToken, $cardF4L4, $cardF4L4Skip, $params = array())
    {
        $required_array = array(
            'amount' => $amount,
            'customerCode' => $customerCode,
            'cardToken' => $cardToken,
            'cardF4L4' => $cardF4L4,
            'cardF4L4Skip' => $cardF4L4Skip
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

        $this->xml = $this->master->call('purchase', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/708-helcim-commerce-api-purchase-using-magdata/
     *
     * FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     * terminalId	           Integer	   Yes	       The terminal ID.
       amount	               Decimal	   Yes	       The transaction amount.
       cardMag	               String	   Yes	       The credit card magnetic strip data. (Use this input if the magnetic stripe data is not encrypted, or use the cardMagEnc and serialNumber if the magnetic stripe data is encrypted.
       serialNumber	           String	   Yes	       The terminal serial number.
       cardMagEnc	           String	   Yes	       The credit card magnetic strip data (Encrypted).
     *
     * @return $this
     */
    public function purchaseWithMag($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('purchase', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/709-helcim-commerce-api-purchase-using-customer-code/
     *
     * FIELD NAME               TYPE        REQUIRED    DESCRIPTION
     * customerCode	            String	    Yes	        The customer ID code.
       amount	                Decimal	    Yes	        The amount of the transaction.
       comments	                String	    No	        Extra comments added to the transaction.
     *
     * @return $this
     */
    public function purchaseWithCustomerCode($amount, $customerCode, $params = array())
    {
        $required_array = array(
            'amount' => $amount,
            'customerCode' => $customerCode,
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

        $this->xml = $this->master->call('purchase', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/711-helcim-commerce-api-preauthorization-preauth/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  amount	                Decimal	    Yes	        The amount of the transaction.
        cardHolderName	        String	    No	        The cardholder names.
        cardNumber	            Integer	    Yes	        The credit card number.
        cardExpiry	            Integer	    Yes	        The credit card expiration date
        cardCVV	                Integer	    No	        The credit card CVV (digits on back of credit card).
        cardHolderAddress	    String	    No	        The card holder's address.
        cardHolderPostalCode	String	    No	        The card holder's postal code.
        orderNumber	            String	    No	        The order number.
        comments	            String	    No	        Optional comments.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function preAuthorize($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('preauth', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/974-helcim-commerce-api-preauthorization-preauth-with-customer-code/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  amount	                Decimal	    Yes	        The amount of the transaction.
        customerCode	        String	    Yes	        The Helcim Commerce customer code.
        orderNumber	            String	    No	        The order number.
        comments	            String	    No	        Optional comments.
        billing_contactName	    String	    No	        The billing contact name.
        billing_businessName	String	    No	        The billing business name.
        billing_street1	        String	    No	        The billing street address.
        billing_street2	        String	    No	        The billing street address.
        billing_city	        String	    No	        The billing city.
        billing_province	    String	    No	        The billing province.
        billing_country	        String	    No	        The billing country.
        billing_postalCode	    String	    No	        The billing postal code.
        billing_phone	        String	    No	        The billing phone number.
        billing_fax	            String	    No	        The billing fax number.
        billing_email	        String	    No	        The billing email address.
        shipping_contactName	String	    No	        The shipping contact name.
        shipping_businessName	String	    No	        The shipping business name.
        shipping_street1	    String	    No	        The shipping street address.
        shipping_street2	    String	    No	        The shipping street address.
        shipping_city	        String	    No	        The shipping city.
        shipping_province	    String	    No	        The shipping province.
        shipping_country	    String	    No	        The shipping country.
        shipping_postalCode	    String	    No	        The shipping postal code.
        shipping_phone	        String	    No	        The shipping phone number.
        shipping_fax	        String	    No	        The shipping fax number.
        shipping_email	        String	    No	        The shipping email address.
        amountShipping	        Decimal 	No	        The shipping cost.
        amountTax	            Decimal	    No	        The total tax amount.
        shippingMethod	        String	    No	        The shipping method.
        taxDetails	            String	    No	        The tax name.
        itemSKU#	            Integer	    No	        The sku. NOTICE: For all item variables replace "#" with a unique item number (starting at 1, and increasing by 1 for each unique item added).
        itemDescription#	    String	    No	        The item description.
        itemSerialNumber#	    String	    No	        The item serial number.
        itemQuantity#	        Decimal	    No	        Item quantity, must be at least one for item to be added.
        itemPrice#	            Decimal	    No	        The item price.
        itemTotal#	            Decimal	    No	        The item price multiplied by the quantity.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function preAuthorizeWithCustomerCode($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('preauth', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/974-helcim-commerce-api-preauthorization-preauth-with-customer-code/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  amount	                Decimal	    Yes	        The amount of the transaction.
        cardToken	            String	    Yes	        The Helcim Commerce credit card token.
        cardF4L4	            Integer	    Yes	        The credit card number.
        cardF4L4Skip	        Integer	    No	        1 or 0.  If set to 1, then cardF4L4 field is not required.
        orderNumber	            String	    No	        The order number.
        comments	            String	    No	        Optional comments.
        billing_contactName	    String	    No	        The billing contact name.
        billing_businessName	String	    No	        The billing business name.
        billing_street1	        String	    No	        The billing street address.
        billing_street2	        String	    No	        The billing street address.
        billing_city	        String	    No	        The billing city.
        billing_province	    String	    No	        The billing province.
        billing_country	        String	    No	        The billing country.
        billing_postalCode	    String	    No	        The billing postal code.
        billing_phone	        String	    No	        The billing phone number.
        billing_fax	            String	    No	        The billing fax number.
        billing_email	        String	    No	        The billing email address.
        shipping_contactName	String	    No	        The shipping contact name.
        shipping_businessName	String	    No	        The shipping business name.
        shipping_street1	    String	    No	        The shipping street address.
        shipping_street2	    String	    No	        The shipping street address.
        shipping_city	        String	    No	        The shipping city.
        shipping_province	    String	    No	        The shipping province.
        shipping_country	    String	    No	        The shipping country.
        shipping_postalCode	    String	    No	        The shipping postal code.
        shipping_phone	        String	    No	        The shipping phone number.
        shipping_fax	        String	    No	        The shipping fax number.
        shipping_email	        String	    No	        The shipping email address.
        amountShipping	        Decimal 	No	        The shipping cost.
        amountTax	            Decimal	    No	        The total tax amount.
        shippingMethod	        String	    No	        The shipping method.
        taxDetails	            String	    No	        The tax name.
        itemSKU#	            Integer	    No	        The sku. NOTICE: For all item variables replace "#" with a unique item number (starting at 1, and increasing by 1 for each unique item added).
        itemDescription#	    String	    No	        The item description.
        itemSerialNumber#	    String	    No	        The item serial number.
        itemQuantity#	        Decimal	    No	        Item quantity, must be at least one for item to be added.
        itemPrice#	            Decimal	    No	        The item price.
        itemTotal#	            Decimal	    No	        The item price multiplied by the quantity.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function preAuthorizeWithCardToken($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('preauth', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/712-helcim-commerce-api-verificationonly/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode	        String	    No	        The customer code.
        cardHolderName	        String	    No	        The cardholder names.
        cardNumber	            Integer	    Yes	        The credit card number.
        cardExpiry	            Integer	    Yes	        The credit card expiration date
        cardCVV	                Integer	    Yes	        The credit card CVV (digits on back of credit card).
        cardHolderAddress	    String	    No	        The card holder's address.
        cardHolderPostalCode	String	    No	        The card holder's postal code.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function verifyOnly($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('verify', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/713-helcim-commerce-api-refund-return/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
        amount	                Decimal	    Yes	        The amount of the transaction.
        cardHolderName	        String	    No	        The cardholder names.
        cardNumber	            Integer	    Yes	        The credit card number.
        cardExpiry	            Integer	    Yes	        The credit card expiration date
        cardCVV	                Integer	    No	        The credit card CVV (digits on back of credit card).
     *
     * @return $this
     */
    public function refund($amount, $cardNumber, $cardExpiry, $params = array())
    {
        $required_array = array(
            'amount' => $amount,
            'cardNumber' => $cardNumber,
            'cardExpiry' => $cardExpiry
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

        $this->xml = $this->master->call('refund', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/714-helcim-commerce-api-capture-force/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        Integer	    Yes	        The transaction ID.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function capture($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('capture', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/715-helcim-commerce-api-batch-settlement/
     *
     * @return $this
     */
    public function batchSettlement($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('settle', $params, true);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/957-helcim-commerce-api-void/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        Integer	    Yes	        The transaction ID.
        ipAddress	            String	    No	        IP Address of the customer making the transaction
     *
     * @return $this
     */
    public function void($transactionId, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId,
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

        $this->xml = $this->master->call('void', $params, true);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}
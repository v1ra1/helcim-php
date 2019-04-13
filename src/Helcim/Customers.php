<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */

class Helcim_Customers {

    private $xml;

    public function __construct(Helcim $master) {
        $this->master = $master;
    }

    /*
     * @reference https://www.helcim.com/support/article/648-helcim-commerce-api-view-a-customer/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode	        String	    Yes	        The customer code.
     *
     * @return $this
     */
    public function fetchCustomer($params)
    {
        if(is_array($params)) {
            $customerCode = isset($params['customerCode']) ? $params['customerCode'] : NULL;
        } else {
            $customerCode = $params;
        }
        $this->xml = $this->master->call('customerView', array(
            'customerCode' => $customerCode
        ));
        return $this;
    }

    /*
     *  @reference https://www.helcim.com/support/article/649-helcim-commerce-api-add-or-edit-a-customer/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  businessName	        String	    No	        The business name. Either the business name or the contact name must be entered.
        customerCode	        String	    No	        The customer code. If it is not entered then you are adding a customer.  If it is entered then you are editing an existing customer.
        contactName	            String	    No	        The contact name. Either the business name or the contact name must be entered.
        billing_contactName	    String	    No	        The contact name for the billing address.
        billing_businessName	String	    No	        The business name for the billing address.
        billing_street1	        String	    No	        The street address for the billing address.
        billing_street2	        String	    No	        The street address for the billing address.
        billing_city	        String	    No	        The city for the billing address.
        billing_province	    String	    No	        The province for the billing address.
        billing_country	        String	    No	        The country for the billing address.
        billing_postalCode	    String	    No	        The postal code for the billing address.
        billing_phone	        String	    No	        The phone number for the billing address.
        billing_fax	            String	    No 	        The fax number for the billing address.
        billing_email	        String	    No	        The email address for the billing address.
        shipping_contactName	String	    No	        The contact name for the shipping address.
        shipping_businessName	String	    No	        The business name for the shipping address.
        shipping_street1	    String	    No	        The street address for the shipping address.
        shipping_street2	    String	    No	        The street address for the shipping address.
        shipping_city	        String	    No	        The city for the shipping address.
        shipping_province	    String	    No	        The province for the shipping address.
        shipping_country	    String	    No	        The country for the shipping address.
        shipping_postalCode	    String	    No	        The postal code for the shipping address.
        shipping_phone	        String	    No	        The phone number for the shipping address.
        shipping_fax	        String	    No	        The fax number for the shipping address.
        shipping_email	        String	    No	        The email address for the shipping address.
     *
     * @return $this
     */
    public function addOrEditCustomer($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerEdit', $params);
        return $this;
    }


    /*
     * @reference https://www.helcim.com/support/article/650-helcim-commerce-api-add-a-credit-card/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode	        String	    Yes	        The customer code.
        cardHolderName	        String	    Yes	        The card holder's name.
        cardNumber	            Integer	    Yes	        The credit card number.
        cardExpiry	            String	    Yes	        The credit card expiry date.
        cardCVV	                Integer	    No	        The card verification value.
        cardToken	            String	    No	        If entered, user is editing an existing card
        default	                Integer	    No	        1 or 0. Whether the card is set as default or not.
        cardHolderAddress	    String	    No	        The card holder's address.
        cardHolderPostalCode	String	    No	        The card holder's postal code.
        terminalId	            Integer	    No	        The terminal ID.
        verify	                Integer	    No	        1 or 0. Whether the card will be verified or not.

        @return $xml
     */
    public function addCreditCard($params)
    {
        if(!is_array($params)) {
            $this->master->log(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
            throw new Helcim_Error(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerCardEdit', $params);
        return $this;
    }


    /*
     * @reference https://www.helcim.com/support/article/654-helcim-commerce-api-edit-a-credit-card/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
        customerCode	        String	    Yes	        The customer code.
        cardToken	            String	    Yes	        The credit card token.
        cardHolderName	        String	    No	        The card holder's name.
        cardNumber	            Integer	    No	        The credit card number.
        cardExpiry	            String	    No	        The credit card expiry date.
        cardCVV	                Integer	    No	        The card verification value.
        cardHolderAddress	    String	    No	        The card holder's address.
        cardHolderPostalCode	String	    No	        The card holder's postal code.
        terminalId	            Integer	    No	        The terminal ID.
        verify	                Integer	    No	        1 or 0. Whether the card will be verified or not.

        @return $xml
     */
    public function editCreditCard($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerCardEdit', $params);
        return $this;
    }

    /*
     *
     *  @reference https://www.helcim.com/support/article/651-helcim-commerce-api-add-or-edit-a-bank-account/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  customerCode	        String	    Yes	        The customer code.
        postalCode	            String	    Yes	        The postal code.
        country	                String	    Yes	        The country.
        province	            String	    Yes	        The province.
        city	                String	    Yes	        The city.
        streetAddress	        String	    Yes	        The street address.
        companyName	            String	    Yes	        The company name.
        lastName	            String	    Yes	        The last name.
        firstName	            String	    Yes	        The first name.
        bankAccountNumber	    Integer	    Yes	        The bank account number.
        bankTransitNumber	    Integer	    Yes	        The bank account transit number.
        accountCorporate	    String	    Yes	        The account category (P-personal, C-corporate).
        accountType	            String	    Yes	        The type of accoung (CHK-chequing, SAV-savings).
        bankAccountToken	    String	    No	        The bank accoung token. If it is entered then you are editing an existing bank account.
                                                        If it is not entered then you are adding a new bank account
        @return $xml
     */
    public function addOrEditBankAccount($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerBankAccountEdit', $params);
        return $this;
    }

    /*
     * @reference https://www.helcim.com/support/article/652-helcim-commerce-api-list-customers/
     *
     * @return $this
     */
    public function listCustomers($params)
    {
        if(!is_array($params)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerSearch', $params);
        return $this;
    }

    /*
     * @reference https://www.helcim.com/support/article/653-helcim-commerce-api-list-detailed-customers/
     *
     * @return $this
     */
    public function listDetailedCustomers($params)
    {
        if(!is_array($params)) {
            $this->master->log(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
            throw new Helcim_Error(__CLASS__." Error: ".__FUNCTION__." -> You need to provide a array of request data");
        }

        $this->xml = $this->master->call('customerSearchDetail', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}
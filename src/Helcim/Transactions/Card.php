<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Transactions_Card
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/669-helcim-commerce-api-view-a-transaction/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        String	    Yes	        The transaction ID.
     *
     * @return $this
     */
    public function viewTransaction($transactionId, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId
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

        $this->xml = $this->master->call('transactionView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/670-helcim-commerce-api-list-transactions/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  search	                String	    No	        Searches either amount, cardNumber, cardHolderName, approvalCode.
        dateFrom	            String	    No	        YYYY-MM-DD
        dateTo	                String	    No	        YYYY-MM-DD
     *
     * @return $this
     */
    public function listTransactions($params = array())
    {
        $this->xml = $this->master->call('transactionSearch', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/671-helcim-commerce-api-helcim-fraud-defender/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        String	    Yes	        The transaction ID.
     *
     * @return $this
     */
    public function fraudDefender($transactionId, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId
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

        $this->xml = $this->master->call('transactionDefender', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/672-helcim-commerce-api-save-a-transaction-signature/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        String	    Yes	        The transaction ID.
        signature	            String	    Yes	        BASE-64 Encoded
     *
     * @return $this
     */
    public function saveTransactionSignature($transactionId, $signature, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId,
            'signature' => $signature
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

        $this->xml = $this->master->call('transactionSignatureSave', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/673-helcim-commerce-api-view-a-transaction-signature/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        String	    Yes	        The transaction ID.
     *
     * @return $this
     */
    public function viewTransactionSignature($transactionId, $params = array())
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

        $this->xml = $this->master->call('transactionSignatureSave', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/674-helcim-commerce-api-send-a-transaction-receipt/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  transactionId	        String	    Yes	        The transaction ID.
        emailAddress	        String	    Yes	        The email address the receipt is being sent to.
     *
     * @return $this
     */
    public function sendTransactionReceipt($transactionId, $emailAddress, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId,
            'emailAddress' => $emailAddress
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

        $this->xml = $this->master->call('transactionEmailReceipt', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/675-helcim-commerce-api-create-a-transaction-pdf/
     *
     * FIELD NAME              TYPE        REQUIRED    DESCRIPTION
       transactionId	       String	   Yes	       The transaction ID.
     *
     * @return $this
     */
    public function createTransactionPDF($transactionId, $params = array())
    {
        $required_array = array(
            'transactionId' => $transactionId
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

        $this->xml = $this->master->call('transactionPDF', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/676-helcim-commerce-api-view-a-batch/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  batchNumber	            Integer	    Yes	        The batch number.
        terminalId	            Integer	    Yes	        The terminal ID.
     *
     * @return $this
     */
    public function viewBatch($batchNumber, $terminalId, $params = array())
    {
        $required_array = array(
            'batchNumber' => $batchNumber,
            'terminalId' => $terminalId
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

        $this->xml = $this->master->call('batchView', $params);
        return $this;
    }


    public function getData()
    {
        return $this->xml;
    }

}
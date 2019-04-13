<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */

class Helcim_Recurring
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/661-helcim-commerce-api-view-a-recurring-plan/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  recurringPlanId	        Integer	    Yes	        The recurring plan ID.
     *
     * @return $this
     */
    public function viewRecurringPlan($recurringPlanId, $params = array())
    {
        $required_array = array(
            'recurringPlanId' => $recurringPlanId,
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

        $this->xml = $this->master->call('recurringPlanView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/662-helcim-commerce-api-queue-a-recurring-plan-for-processing/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  recurringPlanId	        Integer	    Yes	        The recurring plan ID.
     *
     * @return $this
     */
    public function queueRecurringPlan($recurringPlanId, $params = array())
    {
        $required_array = array(
            'recurringPlanId' => $recurringPlanId,
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

        $this->xml = $this->master->call('recurringPlanQueue', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/663-helcim-commerce-api-add-or-edit-a-subscription/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  subscriptionId	        String	    No	        The subscription ID.  If its present then you are editing a subscription plan.  If it is not present, then you are adding a new subscription plan.
        recurringPlanId	        Integer	    No	        The recurring plan ID. If subscriptionId is present then recurringPlanId is optional.  If subscriptionId is not entered then recurringPlanId is required.
        customerCode	        String 	    No	        The customer code. If subscriptionId is present then customerCode is optional. If subscriptionId is not entered then customerCode is required.
        dateCreated	            String	    No	        The creation date of the subscription.
        dateStarted	            String	    No	        The start date of the subscription.
        dateRemoved	            String	    No	        The end date of the subscription.
        amountRecurring	        Decimal	    No	        The recurring amount.
        amountInitial	        Decimal	    No	        The initial amount.
        cyclesTotal	            Integer	    No	        The total number of payment cycles.
        status	                Integer	    No	        1 or 0. Whether the subscription is active or not.
     *
     * @return $this
     */
    public function addOrEditSubscription($params = array())
    {
        $this->xml = $this->master->call('subscriptionEdit', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/664-helcim-commerce-api-view-a-subscription/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  subscriptionId	        Integer	    Yes	        The subscription ID.
     *
     * @return $this
     */
    public function viewSubscription($subscriptionId, $params = array())
    {
        $required_array = array(
            'subscriptionId' => $subscriptionId,
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
        $this->xml = $this->master->call('subscriptionView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/853-helcim-commerce-api-subscription-list/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  status	                String	    No	        The status of the subscription. (Accepted values: due, expiring, trial, expired, cancelled)
        customerCode	        String	    No	        The customer code
        recurringPlanCode	    String	    No	        The recurring plan code
        dateStartedFrom	        String	    No	        Format: YYYY-MM-DD
        dateStartedTo	        String 	    No	        Format: YYYY-MM-DD
        dateCreatedFrom	        String	    No	        Format: YYYY-MM-DD
        dateCreatedTo	        String	    No	        Format:YYYY-MM-DD
     *
     * @return $this
     */
    public function subscriptionList($params = array())
    {
        $this->xml = $this->master->call('subscriptionSearch', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}
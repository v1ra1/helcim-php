<?PHP
require_once("Helcim/Payments/Card.php");
require_once("Helcim/Payments/ACH.php");
require_once("Helcim/Payments/Misc.php");
require_once("Helcim/Payments/Payments.php");
require_once("Helcim/Transactions/Card.php");
require_once("Helcim/Transactions/ACH.php");
require_once("Helcim/Transactions/Other.php");
require_once("Helcim/Transactions/Transactions.php");
require_once("Helcim/Customers.php");
require_once("Helcim/Inventory.php");
require_once("Helcim/Orders.php");
require_once("Helcim/Recurring.php");
require_once("Helcim/Settings.php");
require_once("Helcim/Misc.php");
require_once("Helcim/Exceptions.php");

class Helcim {

    const VERSION = '1.0';

    /**
     * API version.
     *
     * @var string $version
     */
    public $version = self::VERSION;

    /**
     * The CURL client.
     *
     * @var CURL $ch
     */
    protected $ch;

    /**
     * The REST API endpoint.
     *
     * @var string $endpoint
     */
    protected $endpoint = 'https://secure.myhelcim.com/api/';

    /**
     * The Helcim accountId to authenticate with.
     *
     * @var string $accountId
     */
    private $accountId;

    /**
     * The Helcim apiToken to authenticate with.
     *
     * @var string $apiToken
     */
    private $apiToken;

    /**
     * The Helcim test is set if in test mode.
     *
     * @var boolean $action
     */
    private $testMode = false;

    /**
     * The Helcim debug will out put logs.
     *
     * @var boolean $action
     */
    private $debug = false;

    public function __construct($accountId, $apiToken, $opts=array())
    {
        if(!$accountId) {
            throw new Helcim_Error("You must provide a Account Id before initiating Helcim");
        }
        if(!$apiToken) {
            throw new Helcim_Error("You must provide a API Token before initiating Helcim");
        }
        $this->accountId = $accountId;
        $this->apiToken = $apiToken;

        if (!isset($opts['timeout']) || !is_int($opts['timeout'])){
            $opts['timeout'] = 600;
        }
        if (isset($opts['testMode'])){
            $this->testMode = true;
        }
        if (isset($opts['debug'])){
            $this->debug = true;
        }
        $this->ch = curl_init();

        if (isset($opts['CURLOPT_FOLLOWLOCATION']) && $opts['CURLOPT_FOLLOWLOCATION'] === true) {
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        }

        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Helcim-PHP/'.self::VERSION);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $opts['timeout']);


        $this->payments = new Helcim_Payments($this);
        $this->customers = new Helcim_Customers($this);
        $this->inventory = new Helcim_Inventory($this);
        $this->orders = new Helcim_Orders($this);
        $this->transactions = new Helcim_Transactions($this);
        $this->recurring = new Helcim_Recurring($this);
        $this->settings = new Helcim_Settings($this);
        $this->misc = new Helcim_Misc($this);

    }

    public function __destruct() {
        if(is_resource($this->ch)) {
            curl_close($this->ch);
        }
    }

    public function call($action, $params, $transaction = false) {

        if(!isset($action)) {
            throw new Helcim_Error("You have to specify a action before initiating a call");
        }
        $actionName = ($transaction) ? 'transactionType' : 'action';
        $params = array_merge(array($actionName => $action, 'accountId' => $this->accountId, 'apiToken' => $this->apiToken),$params);
        if($this->testMode) {
            $params = array_merge($params, array('test' => true));
        }
        $postvars = '';
        foreach($params as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }
        curl_setopt($this->ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($this->ch, CURLOPT_VERBOSE, $this->test);

        $start = microtime(true);
        $this->log(($this->test ? '[TEST]' : '').' Call to ' . $this->endpoint . ' : ' . $postvars);
        if($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($this->ch, CURLOPT_STDERR, $curl_buffer);
        }
        $response_body = curl_exec($this->ch);

        $info = curl_getinfo($this->ch);
        $time = microtime(true) - $start;
        if($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if(curl_error($this->ch)) {
            $this->castError("API call to $action failed: " . curl_error($this->ch));
        }
        $result = simplexml_load_string($response_body);
        if(isset($result->message) && $result->responseMessage) {
            $this->castError("Error: ".$result->responseMessage);
        }
        return $result;
    }

    public function castError($msg)
    {
        $this->log($msg);
        throw new Helcim_Error($msg);
    }

    public function log($msg) {
        if ($this->debug) {
            error_log($msg);
        }
    }
}
?>
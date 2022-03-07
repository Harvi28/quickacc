<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 3000);
//require "../../vendor/autoload.php";
// include('../usr/share/config.php');



require_once JPATH_COMPONENT_ADMINISTRATOR . '/libraries/vendor/autoload.php';
//require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/DbOperationsHelper.php';
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Account;
use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\PlatformService\PlatformService;
use QuickBooksOnline\API\QueryFilter\QueryMessage;




jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');

class QuickbookHelper extends DbOperationsHelper
{


/*
    https://help.developer.intuit.com/s/topic/0TOG0000000kF9IOAU/general-questions
    https://help.developer.intuit.com/s/article/Validity-of-Refresh-Token

    The Access Token is valid for 1 hour.
    The Refresh Token is valid for 100 days but can change in about a day.

    The Refresh Token API call is used to get a new 1-hour Access Token when the previous access token expires.

    Each Refresh Token lasts up to 100 days before it expires. This means that the user need not sign in and grant consent again until this time. However, it can change around a day later or the next time you make the Refresh Token API call, whichever is later.
    Please note that if a new Refresh Token is returned, the previous one expires.

    Consider the below detailed scenario:
    On day 1, the developer makes a Refresh Token API call using Refresh token A. The response holds the following:
    Access Token A – valid for 60 minutes (1 hour)
    Refresh Token A – valid for 100 days

    On day 2, the developer makes a Refresh Token API call using Refresh token A. The response holds the following:
    Access token B – valid for 60 minutes (1 hour)
    Refresh Token B – valid for 100 days
    On day 2, a new Refresh Token is returned, and Refresh Token A expires. Refresh token A is no longer valid for making the Refresh Token API call to get a new access token. The Refresh Token API call will throw an “invalid_grant” error if you attempt to use it.

    For simplicity, always store and use the LATEST Refresh token returned.

    In short, the recommended workflow for all apps is:
    Step 1. If the Access Token fails, use the current Refresh Token to request new Access and Refresh Tokens.
    Step 2. Store BOTH the Access and Refresh Tokens that are returned.
    Step 3. Use the new Access Token for making QuickBooks Online API calls.
    Step 4. When the Access Token fails in 1 hour, go to Step 1.


    check purpose of refresh token
    before every request to quickbook validate access token if true then call
                                                            if false regenerate access token > store it > update data service then call 


*/

    private $config = [];

    private $authUrl;
    private $accessToken;

    public function __construct(){

         $this->config = include(JPATH_COMPONENT_ADMINISTRATOR . '/helpers/QbConfig.php');
        //$this->refreshToken();


    }

    public function initQB(){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->config['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $this->authUrl = $authorizationCodeUrl  = $OAuth2LoginHelper->getAuthorizationCodeURL();

        

        header('Location: '. $authorizationCodeUrl);

    }

    public function getauthUrl(){
        // die("dssd");

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->config['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));
        //echo "<pre>";print_r($this->config);die;

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $this->authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
        // echo "<pre>";
        // print_r($OAuth2LoginHelper->getAuthorizationCodeURL());
        // die("dk");
        // echo $this->authUrl;die;
        return $this->authUrl;
    }

    public function getQB(){
        //die("sd");

        $entryExists = (new DbOperationsHelper())->getEntryArray($this->config['client_id'], "#__laitqb_quickbook","client_id");
        $this->accesstokexpri=$entryExists['access_token_expires_at'];
        // echo '<pre>';print_r($this->accesstokexpri);die;
        $session = JFactory::getSession();

        if(!empty($entryExists)){
            //die("sdsa");
            if($entryExists['access_token_expires_at'] >= date('Y-m-d H:m:s')){
               $entryExists = $this->updatewithAccessToken($entryExists);
            }
            $session->set('laitqb.qb', $entryExists);
        }else{
            $session->clear('laitqb.qb');
        }
        return $entryExists;
    }

    private function updatewithAccessToken($db){
// echo '<pre>';print_r($db);
        //die("fds");

        /*$dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->config['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));


        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();*/

        $ClientID = $this->config['client_id'];
        $ClientSecret = $this->config['client_secret'];

       // echo "<pre>";
       // echo $ClientID;
       // echo "<br>";
       // die("ds");
//        echo $ClientSecret;
//        echo "<br>";
//        print_r($db);
//        die;
        $oauth2LoginHelper = new OAuth2LoginHelper($ClientID,$ClientSecret);
        
       
        $accessTokenObj = $oauth2LoginHelper->refreshAccessTokenWithRefreshToken($db['refresh_token']);

        $accessTokenValue = $accessTokenObj->getAccessToken();
        $refreshTokenValue = $accessTokenObj->getRefreshToken();


        $db['client_id']= $accessTokenObj->getClientID();
        $db['access_token']= $accessTokenValue;
        $db['refresh_token']= $refreshTokenValue;
        $db['refresh_token_expires_at'] = $accessTokenObj->getRefreshTokenExpiresAt();
        $db['access_token_expires_at'] = $accessTokenObj->getAccessTokenExpiresAt();
        $db['user_id']= JFactory::getUser()->id;

        $dbOperation = new DbOperationsHelper();
        $isDone = false;
        $isDone = $dbOperation->updateData('client_id',$db, '#__laitqb_quickbook');

        $session = JFactory::getSession();
        if($isDone){
            $session->set('laitqb.qb', $db);
        }else{
            $session->clear('laitqb.qb');
        }
        return $db;

    }

   

    public static function getInstance()
    {
        return new QuickbookHelper();
    }

    function processCode()
    {

        //die("xcx");
        // Create SDK instance
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->config['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));

        // echo "<pre>";
        // print_r($dataService);
        // die("sdsfd");


        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        // echo "<pre>";
        // print_r($OAuth2LoginHelper);
        // die("sade"); 
        $parseUrl = $this->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
        // print_r($parseUrl);
        // die("sa");
        
        /*
         * Update the OAuth2Token
         */
        // $this->accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);
        // $dataService->updateOAuth2Token($this->accessToken);

        $accessTokenObj = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);

        $dataService->updateOAuth2Token($accessTokenObj);
        // echo "<pre>";
        // print_r($accessTokenObj);
        // die("dfsd");

        $refreshTokenValue = $accessTokenObj->getRefreshToken();
        $accessTokenValue = $accessTokenObj->getAccessToken();


        $storeIt['realm_id']= $parseUrl['realmId'];
        $storeIt['client_id']= $accessTokenObj->getClientID();
        $storeIt['access_token']= $accessTokenValue;
        $storeIt['refresh_token']= $refreshTokenValue;
        $storeIt['refresh_token_expires_at'] = $accessTokenObj->getRefreshTokenExpiresAt();
        $storeIt['access_token_expires_at'] = $accessTokenObj->getAccessTokenExpiresAt();
        $storeIt['user_id']= JFactory::getUser()->id;

        $dbOperation = new DbOperationsHelper();
        $entryExists = $dbOperation->getEntryArray($this->config['client_id'], "#__laitqb_quickbook","client_id");
   
        $isDone = false;
        if(empty($entryExists)){
            $isDone = $dbOperation->makeEntry($storeIt, "#__laitqb_quickbook");
        }else{
            $isDone = $dbOperation->updateData('id',$storeIt, '#__laitqb_quickbook');
        }

        $session = JFactory::getSession();
        if($isDone){
            $session->set('laitqb.qb', $storeIt);
        }else{
            $session->clear('laitqb.qb');
        }

       

        return true;

        // $this->refreshToken();
        /*
         * Setting the accessToken for session variable
         */
        // $_SESSION['sessionAccessToken'] = $accessToken;
    }

     function createAccount()
    {
       //die("dfd"); 
        $data = JFactory::getApplication()->input;
        
        $qb = $this->getQB();
      
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'QBORealmID' => $qb['realm_id'],
            'ClientID' => $qb['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'accessTokenKey' => $qb['access_token'],
            'refreshTokenKey' => $qb['refresh_token'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));
        


        $theResourceObj = Account::create([
        "AcctNum" => $data->get('acc_num'),
        "Name" => $data->get('acc_name'),
        "AccountType" => "Bank"

        ]);

        $resultingObj = $dataService->Add($theResourceObj);
        
        $error = $dataService->getLastError();
        if ($error) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
        }
        else {
            return $resultingObj;
        }
    }

    function readAccount()
    {
       
         $data = JFactory::getApplication()->input;
        

        $qb = $this->getQB();
       
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $qb['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'accessTokenKey' => $qb['access_token'],
            'refreshTokenKey' => $qb['refresh_token'],
            'QBORealmID' => $qb['realm_id'],
            'baseUrl' => $this->config['base_url']
        ));
        
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $dataService->throwExceptionOnError(true);
        $account = $dataService->FindAll('account');
        
       
        $error = $dataService->getLastError();
        
        if ($error) 
        {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
        }
        else 
        {
            return $account;
        
        }
            
    }

    function getAccount($id)
    {
       
        $data = JFactory::getApplication()->input;
        

       $qb = $this->getQB();

        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $qb['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'accessTokenKey' => $qb['access_token'],
            'refreshTokenKey' => $qb['refresh_token'],
            'QBORealmID' => $qb['realm_id'],
            'baseUrl' => $this->config['base_url']
        ));

        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $dataService->throwExceptionOnError(true);
        
        $account = $dataService->FindbyId('account',$id);

       

        $error = $dataService->getLastError();
        if ($error) 
        {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
            exit();
        }
        // Echo some formatted output
        
        else
        {   

            return $account;

        }
 

    }

    function updateAccount()
    {
       //die("dfd"); 
        $data = JFactory::getApplication()->input;
        

        $qb = $this->getQB();
       //echo "<pre>";print_r($qb);die;
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'QBORealmID' => $qb['realm_id'],
            'ClientID' => $qb['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'accessTokenKey' => $qb['access_token'],
            'refreshTokenKey' => $qb['refresh_token'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'scope' => $this->config['oauth_scope'],
            'baseUrl' => $this->config['base_url']
        ));
         //$pc = $this->processCode();
        // echo "<pre>";
        // print_r($dataService);
        // die("hg");
       

        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $dataService->throwExceptionOnError(true);
        // echo $data->get('Id');die;
        $account = $dataService->FindbyId('account', $data->get('id'));
        // echo "<pre>";print_r($account);die;

        $theResourceObj = Account::update($account, [
        "AcctNum" => $data->get('acc_num'),
        "Name" => $data->get('acc_name'),
        
        "AccountType" => "Bank"

        // "AccountSubType" => "Cash on hand"
        ]);

        $resultingObj = $dataService->Update($theResourceObj);
        // echo "<pre>";
        // print_r($resultingObj);
        // die("sda");
        $error = $dataService->getLastError();
        if ($error) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
        }
        else {
            return $resultingObj;
        }
    }

    function parseAuthRedirectUrl($url)
    {
       // die("sdd");
        parse_str($url,$qsArray);
        return array(
            'code' => $qsArray['code'],
            'realmId' => $qsArray['realmId']
        );
        // echo "<pre>";
        // print_r($array);
        // die("sdgf");
    }

    private function setQBTokenInDB($refreshToken, $realmId = NULL , $accessToken = NULL){
        // please code bro
    }


    function refreshToken()
    {

         /*
         * Retrieve the accessToken value from session variable
         */
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->config['client_id'],
            'ClientSecret' =>  $this->config['client_secret'],
            'RedirectURI' => $this->config['oauth_redirect_uri'],
            'baseUrl' => "development",
            'refreshTokenKey' => $this->accessToken->getRefreshToken(),
            'QBORealmID' => "The Company ID which the app wants to access",
        ));

        /*
         * Update the OAuth2Token of the dataService object
         */
        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $refreshedAccessTokenObj = $OAuth2LoginHelper->refreshToken();
        $dataService->updateOAuth2Token($refreshedAccessTokenObj);

        // $_SESSION['sessionAccessToken'] = $refreshedAccessTokenObj;

        /*echo "<pre>";
        print_r($refreshedAccessTokenObj);
        die;*/
        // return $refreshedAccessTokenObj;
    }


    public function isQBTokenValid(){
        return true;
    }



}

?>


<!-- 
http://300e-103-250-153-115.ngrok.io/joomla/administrator/index.php?option=com_laitqb&task=dashboard.callBack
http://1bae-103-250-153-115.ngrok.io/joomla/administrator/index.php?option=com_laitqb&task=dashboard.callBack -->
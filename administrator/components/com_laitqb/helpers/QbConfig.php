<?php

$nice = JComponentHelper::getParams('com_laitqb');

$is_qb_on = $nice->get('is_qb_on');
//echo "$is_qb_on = ".$is_qb_on."<br>";
$client_id = $nice->get('client_id');
//echo "$client_id = ".$client_id."<br>";
$client_secret = $nice->get('client_secret');
//echo "$client_secret = ".$client_secret."<br>";
$oauth_scope = $nice->get('oauth_scope');
//echo "$oauth_scope = ".$oauth_scope."<br>";
$oauth_redirect_uri = $nice->get('oauth_redirect_uri');
//echo "$oauth_redirect_uri = ".$oauth_redirect_uri."<br>";
$base_url = $nice->get('base_url');
//echo "$base_url = ".$base_url."<br>";

/*
        'authorizationRequestUrl' => 'https://appcenter.intuit.com/connect/oauth2',
        'tokenEndPointUrl' => 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer',
        'client_id' => 'ABnds2mrj2oFq29WsWM81Fsmw5jNBEluAuS5ku9y0Xz5i5PozW',
        'client_secret' => 'l4M7skPlh5JjuXQ2N5n7RMH8641zRygFvHyEYhT8',
        'oauth_scope' => 'com.intuit.quickbooks.accounting openid profile email phone address',
        'oauth_redirect_uri' => 'http://localhost/joomla/quickbook/administrator/index.php?option=com_laitqb&task=dashboard.callBack',
        'base_url' => 'Development'
*/

return array(
    'authorizationRequestUrl' => 'https://appcenter.intuit.com/connect/oauth2',
    'tokenEndPointUrl' => 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer',
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'oauth_scope' => $oauth_scope,
    'oauth_redirect_uri' => $oauth_redirect_uri,
    'base_url' => $base_url
)
?>
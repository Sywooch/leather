<?php 

namespace common\models;

use yii\authclient\OAuth1;

/**
* 
*/
class EtsyApi extends OAuth1
{
	public $consumerKey = "ohzjjz6ww5hbgjpq4v33lcyz";
	public $consumerSecret = "ohzjjz6ww5hbgjpq4v33lcyz";
	public $accessTokenUrl = "https://openapi.etsy.com/v2/oauth/request_token";
	// ?scope=email_r%20listings_r

}



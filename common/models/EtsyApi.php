<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use common\models\H;
// use common\models\EtsyProducts;
// use common\models\Product;
// use common\models\ProductInfo as Info;
// use common\models\ProductImage as Image;



class EtsyApi extends Model
{
	const TOKEN = "ab9d5136ff1af577c5317b9dcbbb2a";
	const TOKEN_SECRET = "b97d5451f1";
	const CONSUMER = "ohzjjz6ww5hbgjpq4v33lcyz";
	const CONSUMER_SECRET = "5unx3xduz8";
	const API_URL = "https://openapi.etsy.com/v2";

	public function getOauth()
	{
		$oauth = new \OAuth(self::CONSUMER, self::CONSUMER_SECRET, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
		$oauth->disableSSLChecks();
		$oauth->setToken(self::TOKEN, self::TOKEN_SECRET);

		return $oauth;
	}

	public static function getCurl($url, $post = false)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POST, $post ? true : false);

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }


	public function getAllFeedbacks($params = [])
	{		
		$oauth = $this->getOauth();
		$url = "https://openapi.etsy.com/v2/users/__SELF__/feedback/as-seller?";

		if (isset($params['next_page'])) {
			$url = "https://openapi.etsy.com/v2/users/__SELF__/feedback/as-seller?limit=50&page=".$params['next_page'];
		}

		$data = $oauth->fetch($url, null, OAUTH_HTTP_METHOD_GET);
	    $json = $oauth->getLastResponse();

	    return json_decode($json, true);
	    // https://www.etsy.com/shop/DianoD/reviews
	}


	public function getFeedbackProduct($transactionId)
	{
		$oauth = $this->getOauth();
		$data = $oauth->fetch("https://openapi.etsy.com/v2/transactions/".$transactionId, null, OAUTH_HTTP_METHOD_GET);
	    $json = $oauth->getLastResponse();
	    
	    return json_decode($json, true);	
	}

	public function getFeedbackProductImage($listingId, $imageListingId)
	{
		$oauth = $this->getOauth();
		$data = $oauth->fetch("https://openapi.etsy.com/v2/listings/".$listingId."/images/".$imageListingId, null, OAUTH_HTTP_METHOD_GET);
	    $json = $oauth->getLastResponse();

	    return json_decode($json, true);
	}

	public function getUser($id)
	{
		$url = self::API_URL . "/users/" . $id . "/profile?api_key=". self::CONSUMER;
        $json = self::getCurl($url);
        $results = json_decode($json, true);
        return $results;
	}
}



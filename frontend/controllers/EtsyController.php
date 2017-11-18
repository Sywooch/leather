<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\Category;
use common\models\H;
use common\models\Etsy;
use common\models\EtsyApi as API;
use common\models\EtsyFeedbacks;
use frontend\models\ContactForm;

// use yii\authclient\OAuth1;


class EtsyController extends Controller
{
	public function actionIndex()
	{
		$action = Yii::$app->request->get('action');
		$etsy = new Etsy();
		switch ($action) {
			case 'set-products':
				$etsy->saveEtsyProducts();
				break;
			case 'set-images':
				$etsy->saveProductImage();
				break;
			case 'export-products':
				$etsy->exportProducts();
				break;
			case 'save-raw-images':
				$etsy->saveRawImages();
				break;
			case 'set-images-to-products':
				$etsy->setUpImagesFromEtsy();
				break;
			default:
				die('DD');
				
		}
	}

	public function actionTest()
	{
		$etsy = new EtsyFeedbacks();		

		// 1.
		// $feedbacks = $etsy->saveRawFeedbacks();		
		
		// 2.
		// $etsy->setProductsToFeedbacks();

		// 3.
		// $etsy->setProductImagesToFeedbacks();

		// $etsy->setBuyerNameToFeedbacks();
		


		// H::ddd($feedbacks);
		// $x = $this->getAllFeedbacks();
		// $x = $this->getFeedbackProductImage();
		// H::ddd($x);
		// $key1 = "ohzjjz6ww5hbgjpq4v33lcyz";
		// $key2 = "5unx3xduz8";
		// $oauth = new \OAuth($key1, $key2);
		// $oauth->disableSSLChecks();
		// $req_token = $oauth->getRequestToken("https://openapi.etsy.com/v2/oauth/request_token?scope=feedback_r%20transactions_r", 'oob');
		// H::ddd($req_token);

		// $oauthToken = "db48bfd01c04c4f95874a9eea44ac5";
		// $oauthTokenSecret = "dba55e6818";
		// $verifyer = "be0fbfe4";

		// $oauth = new \OAuth($key1, $key2);
		// $oauth->disableSSLChecks();
		// $oauth->setToken($oauthToken, $oauthTokenSecret);

		// try {
  //   // set the verifier and request Etsy's token credentials url
		//     $acc_token = $oauth->getAccessToken("https://openapi.etsy.com/v2/oauth/access_token", null, $verifyer);
		// } catch (OAuthException $e) {
		//     error_log($e->getMessage());
		// }

		// $oauthToken = "ab9d5136ff1af577c5317b9dcbbb2a";
		// $oauthTokenSecret = "b97d5451f1";

		// $oauth = new \OAuth($key1, $key2, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
		// $oauth->disableSSLChecks();
		// $oauth->setToken($oauthToken, $oauthTokenSecret);

		// try {
		//     $data = $oauth->fetch("https://openapi.etsy.com/v2/oauth/scopes", null, OAUTH_HTTP_METHOD_GET);
		//     $json = $oauth->getLastResponse();
		//     print_r(json_decode($json, true));

		// } catch (OAuthException $e) {
		//     error_log($e->getMessage());
		//     error_log(print_r($oauth->getLastResponse(), true));
		//     error_log(print_r($oauth->getLastResponseInfo(), true));
		//     exit;
		// }
		// die();

		// $x = new OAuth1();
		// $etsy = new EtsyApi();

		// $oauthClient = new EtsyApi();
		// $requestToken = $oauthClient->fetchRequestToken(); 

		// $etsy->getToken();
		// $oauth = $this->ooo();
		// $data = $oauth->fetch("https://openapi.etsy.com/v2/users/__SELF__", null, OAUTH_HTTP_METHOD_GET);
		// $data = $oauth->fetch("https://openapi.etsy.com/v2/users/__SELF__/feedback/as-seller", null, OAUTH_HTTP_METHOD_GET);

	    // $json = $oauth->getLastResponse();
	    // H::ddd(json_decode($json, true));
	}


	// public function ooo()
	// {
	// 	$key1 = "ohzjjz6ww5hbgjpq4v33lcyz";
	// 	$key2 = "5unx3xduz8";
	// 	$oauthToken = "ab9d5136ff1af577c5317b9dcbbb2a";
	// 	$oauthTokenSecret = "b97d5451f1";

	// 	$oauth = new \OAuth($key1, $key2, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
	// 	$oauth->disableSSLChecks();
	// 	$oauth->setToken($oauthToken, $oauthTokenSecret);

	// 	return $oauth;
	// }


	// public function getAllFeedbacks()
	// {
	// 	$oauth = $this->ooo();
	// 	$data = $oauth->fetch("https://openapi.etsy.com/v2/users/__SELF__/feedback/as-seller?limit=70", null, OAUTH_HTTP_METHOD_GET);
	//     $json = $oauth->getLastResponse();

	//     return json_decode($json, true);
	// }

	// public function getFeedbackProduct($transactionId)
	// {
	// 	$oauth = $this->ooo();
	// 	$data = $oauth->fetch("https://openapi.etsy.com/v2/transactions/".$transactionId, null, OAUTH_HTTP_METHOD_GET);
	//     $json = $oauth->getLastResponse();
	    
	//     return json_decode($json, true);	
	// }

	// public function getFeedbackProductImage($listingId = 530685017, $imageListingId = 1199733016)
	// {
	// 	$oauth = $this->ooo();
	// 	$data = $oauth->fetch("https://openapi.etsy.com/v2/listings/".$listingId."/images/".$imageListingId, null, OAUTH_HTTP_METHOD_GET);
	//     $json = $oauth->getLastResponse();
	    
	//     return json_decode($json, true);	
	// }

	
}
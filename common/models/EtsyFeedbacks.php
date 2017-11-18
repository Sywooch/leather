<?php

namespace common\models;

use Yii;
use common\models\H;
use common\models\EtsyApi as API;



class EtsyFeedbacks extends \yii\db\ActiveRecord
{

    const EXPORT_STATUS_RAW = 0;
    const EXPORT_STATUS_SET_PRODUCT = 1;
    const EXPORT_STATUS_SET_PRODUCT_IMAGE = 2;
    const EXPORT_STATUS_READY_TO_USE = 3;

    const CACHE_TIME = 50;//60 * 60 * 24;
    const CACHE_NAME = 'etsy_reviews';


    public static function tableName()
    {
        return 'etsy_feedbacks';
    }


    public function rules()
    {
        return [
            [['feedback_id', 'feedback_serialize'], 'required'],
            [['feedback_id', 'export_status'], 'integer'],
            [['feedback_serialize'], 'string'],
            [['allShopFeedbacks'], 'safe'],
        ];
    }

    public $allShopFeedbacks;
    public function getAllFeedbacks($page = 1)
    {
        $api = new API();
        $feedbacks = $api->getAllFeedbacks(['next_page'=>$page]);
        if ($feedbacks['count']){
            foreach ($feedbacks['results'] as $result) {
                $this->allShopFeedbacks[] = $result;
            }
        }

        if ((int)$feedbacks['pagination']['next_page'] != 0) {
            $this->getAllFeedbacks((int)$feedbacks['pagination']['next_page']);
        }
        return $this->allShopFeedbacks;
    }

    public function saveRawFeedbacks()
    {
        $allFeedbackIds = self::find()->select(['feedback_id'])->all(); 
        $fIds = [];
        foreach ($allFeedbackIds as $id) {
            $fIds[] = $id->feedback_id;
        }

        $allFeedbacks = $this->getAllFeedbacks();
        if (!empty($allFeedbacks)) {
            $f = new EtsyFeedbacks();
            foreach ($allFeedbacks as $feedback) {
                if (!in_array($feedback['feedback_id'], $fIds)) {
                    $f->isNewRecord = true;
                    $f->id = null;
                    $f->feedback_id = $feedback['feedback_id'];
                    $f->feedback_serialize = serialize($feedback);
                    $f->export_status = self::EXPORT_STATUS_RAW;
                    $f->save();    
                }                
            }
        }        
    }

    public function setProductsToFeedbacks()
    {
        $rawFeedbacks = self::find()->where(['export_status'=>self::EXPORT_STATUS_RAW])->limit(20)->all(); 
        if ($rawFeedbacks) {
            $api = new API();
            foreach ($rawFeedbacks as $feedback) {
                $obj = unserialize($feedback->feedback_serialize);
                $product = $api->getFeedbackProduct($obj['transaction_id']);
                if ($product['count']) {
                    foreach ($product['results'] as $p) {
                        $obj['products'][] = [
                            'title' => $p['title'],
                            'listing_id' => $p['listing_id'],
                            'image_listing_id' => $p['image_listing_id'],                            
                        ];
                    }
                }
                $feedback->feedback_serialize = serialize($obj);
                $feedback->export_status = self::EXPORT_STATUS_SET_PRODUCT;
                $feedback->update();
            }
        }
    }

    public function setProductImagesToFeedbacks()
    {
        $productFeedback = self::find()->where(['export_status'=>self::EXPORT_STATUS_SET_PRODUCT])->limit(20)->all(); 
        if ($productFeedback) {
            $api = new API();
            foreach ($productFeedback as $feedback) {
                $obj = unserialize($feedback->feedback_serialize);
                if (isset($obj['products'])) {
                    for ($i=0; $i < count($obj['products']) ; $i++) { 
                        $etsyProduct = $api->getFeedbackProductImage($obj['products'][$i]['listing_id'], $obj['products'][$i]['image_listing_id']);
                        if ($etsyProduct['count'] && isset($etsyProduct['results'][0])) {
                            $obj['products'][$i]['image'] = $etsyProduct['results'][0]['url_170x135'];
                        }
                    }

                    $feedback->feedback_serialize = serialize($obj);
                    $feedback->export_status = self::EXPORT_STATUS_SET_PRODUCT_IMAGE;
                    $feedback->update();
                }
            }
        }
    }


    public function setBuyerNameToFeedbacks()
    {
        $productFeedback = self::find()->where(['export_status'=>self::EXPORT_STATUS_SET_PRODUCT_IMAGE])->limit(20)->all(); 
        if ($productFeedback) {
            $api = new API();
            foreach ($productFeedback as $feedback) {
                $obj = unserialize($feedback->feedback_serialize);
                $user = $api->getUser($obj['buyer_user_id']);
                if ($user['count']) {
                    $result = [];
                    $result['image'] = isset($user['results'][0]['image_url_75x75']) ? $user['results'][0]['image_url_75x75'] : '';
                    $result['name'] = $user['results'][0]['first_name'].' '.$user['results'][0]['last_name'];
                    $obj['buyer'] = $result;
                    $feedback->feedback_serialize = serialize($obj);
                    $feedback->export_status = self::EXPORT_STATUS_READY_TO_USE;
                    $feedback->update();
                }
            }
        }
    }


    public function getFeedbacks()
    {
        $result = [];

        $cache = Yii::$app->cache;
        $result = $cache->get(self::CACHE_NAME);
        if (!$result) {
            $feedbacks = self::find()->where(['export_status' => self::EXPORT_STATUS_READY_TO_USE])->all();
            if ($feedbacks) {
                foreach ($feedbacks as $f) {
                    $result[] = unserialize($f->feedback_serialize);
                }
            }
            $cache->set(self::CACHE_NAME, $result, self::CACHE_TIME);
        }        

        return $result;
    }


  
}

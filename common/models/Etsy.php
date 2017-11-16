<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use common\models\H;
use common\models\EtsyProducts;
use common\models\Product;
use common\models\ProductInfo as Info;
use common\models\ProductImage as Image;

class Etsy extends Model
{
    const SECRET = "ohzjjz6ww5hbgjpq4v33lcyz";
    const SHARED_SECRET = "ohzjjz6ww5hbgjpq4v33lcyz";
    const API_URL = "https://openapi.etsy.com/v2";
    const DIANO_SHOP_ID = '14086403';

    const NOT_EXPORTED = 0;
    const EXPORTED_WITH_NO_IMAGES = 1;
    const EXPORTED_WITH_RAW_IMAGES = 2;
    const FULLY_EXPORTED = 3;

    private static function getCurl($url, $post = false)
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

    public static function getShop()
    {
        $url = self::API_URL .  "/shops/DianoD" ."?api_key=". self::SECRET;
        $json = self::getCurl($url);
        H::ddd($json);
    }

    public function getActiveShopListing()
    {
        $url = self::API_URL . "/shops/" . self::DIANO_SHOP_ID . "/listings/active" . "?limit=50&api_key=". self::SECRET;
        $json = self::getCurl($url);
        $results = json_decode($json);
        return $results;
    }

    public function getActiveProductImages($pId)
    {
        $url = self::API_URL . "/listings/" . $pId . "/images" . "?api_key=". self::SECRET;
        $json = self::getCurl($url);
        $results = json_decode($json);
        return $results;
    }


    public function saveEtsyProducts()
    {
        $allActiveProducts = $this->getActiveShopListing();
        $productsInDb = $this->getDbEtsyProducts();

        if ($allActiveProducts->count && count($allActiveProducts->results) ) {
            foreach ($allActiveProducts->results as $product) {
                if (!in_array((int)$product->listing_id, $productsInDb)) {
                    $p = new EtsyProducts();
                    $p->isNewRecord = true;
                    $p->id = null;
                    $p->etsy_product_id = $product->listing_id;
                    $p->etsy_product_object = serialize($product);
                    $p->save();    
                }                
            }
        }
    }

    public function getDbEtsyProducts()
    {
        $result = [];
        $products = EtsyProducts::find()->select(['etsy_product_id'])->all();
        if ($products) {
            foreach ($products as $product) {
                $result[] = $product->etsy_product_id;
            }            
        }

        return $result;
    }

    public function saveProductImage()
    {
        $products = $this->getDbEtsyProducts();
        if ($products) {
            foreach ($products as $productId) {
                $result = [];
                $images = $this->getActiveProductImages($productId);
                if ($images->count && count($images->results)) {
                    foreach ($images->results as $image) {
                        $result[] = $image->url_fullxfull;    
                    }
                }
                if (!empty($result)) {
                    $p = EtsyProducts::findOne(['etsy_product_id'=>$productId]);
                    if ($p) {
                        $p->images = json_encode($result);
                        $p->update();
                    }
                }
            }
        }
    }

    public function saveEtsyImage($urls, $productId)
    {
        $names = [];
        $folder = Image::getImageFolder('save').$productId;
        FileHelper::createDirectory($folder);
        for ($i=0; $i < count($urls) ; $i++) {
            $name = $productId."_".$i.'.jpg';
            $imageFolder = $folder.'/'.$name;
            if ( file_put_contents($imageFolder, file_get_contents($urls[$i])) ) {
                $names[] = $name;
            } else {
                die('Cant save - '. $i.'---P_id='.$productId);
            }
        }
        return $names;
    }

    public function exportProducts(){
        $products = EtsyProducts::find()->where(['is_exported'=>self::NOT_EXPORTED,'result_id'=>0])->all();
        if (!$products) {
            die('No products for export');
        }

        $product = new Product();
        foreach ($products as $etsyProduct) {
            $model = unserialize($etsyProduct->etsy_product_object);

            $product->isNewRecord = true;
            $product->id = null;
            $product->title = $model->title;
            $product->slug = H::makeSlug($model->title);
            $product->price = (int)$model->price;
            $product->active = 0;
            $product->delete = Product::STATUS_NOT_DELETED;
            $product->has_images = Product::STATUS_NO_IMAGES;
            if ($product->validate()) {
                $product->save();
            }

            if ($product->id) {
                $info = new Info();
                $info->product_id = $product->id;
                $info->description = nl2br(Html::encode($model->description));
                $info->tags = implode(',', $model->tags);
                $info->materials = implode(',', $model->materials);
                $info->save();

                $etsyProduct->is_exported = self::EXPORTED_WITH_NO_IMAGES;
                $etsyProduct->result_id = $product->id;
                $etsyProduct->update();
            }
        }

        die('Exported raw product data without images from Etsy.');
    }


    public function saveRawImages()
    {
        $products = EtsyProducts::find()
                        ->where(['is_exported'=>self::EXPORTED_WITH_NO_IMAGES])
                        ->andWhere(['<>', 'result_id', 0])
                        ->limit(5)
                        ->all();

        if ($products) {
            for ($i=0; $i < count($products) ; $i++) { 
                $images = json_decode($products[$i]->images,1);
                if (!empty($images)) {
                    $names = $this->saveEtsyImage($images, $products[$i]->result_id);
                }
                $products[$i]->is_exported = self::EXPORTED_WITH_RAW_IMAGES;
                $products[$i]->images = json_encode($names);
                $products[$i]->update();
            }

            die('Added raw etsy images to '.count($products).' products');
        }
    }

    public function setUpImagesFromEtsy()
    {
        $products = EtsyProducts::find()
                        ->where(['is_exported'=>self::EXPORTED_WITH_RAW_IMAGES])
                        ->andWhere(['<>', 'result_id', 0])
                        ->limit(2)
                        ->all();
        if ($products) {
            foreach ($products as $etsyProduct) {
                $rawImages = json_decode($etsyProduct->images,1);
                $product = Product::findOne(['id'=>$etsyProduct->result_id]);

                $imageNames = Image::updloadProductImages($product->id, $rawImages, true);

                for ($i=0; $i < count($imageNames); $i++) { 
                    $main = $i == 0 ? 1 : 0;
                    $picture = new Image(['product_id'=>$product->id, 'name'=>$imageNames[$i], 'main'=>$main]);
                    $product->link('allImages', $picture);
                }
                $product->has_images = Product::STATUS_HAS_IMAGES;
                $product->update();

                $etsyProduct->is_exported = self::FULLY_EXPORTED;
                $etsyProduct->update();
            }

            die('Added nice images :)');
        }

        die('Failed');


    }
}

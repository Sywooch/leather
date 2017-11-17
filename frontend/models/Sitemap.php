<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\H;
use common\models\Product;
use yii\helpers\Url;

class Sitemap extends Model
{
    const CACHE_TIME = 10;//60 * 60 * 24;
    const CACHE_NAME = 'sitemap';

    private function getProductsUrls()
    {
        $result = [];
        $condition = Product::findCondition('front');
        $products = Product::find()->where($condition)->asArray()->select(['id', 'slug'])->all();

        if ($products) {
            foreach ($products as $product)
            {
                $result[] = Url::to(['shop/product', 'slug'=>$product['slug'], 'id'=>$product['id']], true);
            }
        }
        return $result;
    }

    private function getHeader()
    {
        $str = '';

        $str .= '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $str .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;
        $str .= '<url>'.PHP_EOL;
        $str .= '<loc>'.Yii::$app->request->getHostInfo().'</loc>'.PHP_EOL;
        $str .= '<changefreq>monthly</changefreq>'.PHP_EOL;
        $str .= '<priority>0.5</priority>'.PHP_EOL;
        $str .= '</url>'.PHP_EOL;

        return $str;
    }

    private function getFooter()
    {
        $str = '</urlset>'; 
        return $str;
    }

    
    public function generateSitemap()
    {
        $result = '';

        $cache = Yii::$app->cache;
        $result = $cache->get(self::CACHE_NAME);
        if (!$result) {
            $productUrls = $this->getProductsUrls();
            // $categoryUrls = $this->getCateoryUrls();    
            
            $result .= $this->getHeader();
            foreach ($productUrls as $url) {
                $result .= '<url>'.PHP_EOL;
                $result .= '<loc>'.$url.'</loc>'.PHP_EOL;
                $result .= '<changefreq>monthly</changefreq>'.PHP_EOL;
                $result .= '<priority>0.5</priority>'.PHP_EOL;
                $result .= '</url>'.PHP_EOL;   
            }

            $result .= $this->getFooter(); 
            $cache->set(self::CACHE_NAME, $result, self::CACHE_TIME);
        }        
        
        return $result;
    }
}

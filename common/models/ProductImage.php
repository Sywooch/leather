<?php

namespace common\models;

use Yii;
use \yii\helpers\FileHelper;
use yii\imagine\Image;
use common\models\H;
use common\models\Product;


class ProductImage extends \yii\db\ActiveRecord
{

    const PRODUCT_IMAGE_FOLDER = "/images/products/";

    public static function tableName()
    {
        return 'product_image';
    }

    public function rules()
    {
        return [
            [['name', 'product_id'], 'required'],
            [['main', 'product_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public static function imageTypes($type = null)
    {
        $sizes = [
            'xs'    =>  ['height'=>100, 'width'=>100, 'quality'=>100],
            'sm'    =>  ['height'=>300, 'width'=>300, 'quality'=>100],
            'md'    =>  ['height'=>820, 'width'=>820, 'quality'=>100],
            'lg'    =>  ['height'=>1200,'width'=>1200, 'quality'=>80],
        ];

        if ($type != null && isset($sizes[$type])) {
            return $sizes[$type];
        } else {
            return $sizes;
        }
    }


     public static function getImageFolder($type = 'save')
    {
        switch ($type) {
            case 'save':
                return $_SERVER['DOCUMENT_ROOT'].self::PRODUCT_IMAGE_FOLDER;
                break;
            case 'show':
                return Yii::$app->request->getHostInfo().self::PRODUCT_IMAGE_FOLDER;
                break;
        }
    }

    public static function getDelimeter()
    {
        return "_dd_";
    }


    public static function showImage($pId, $pictureName, $type = 'md')
    {
        $file = $type.self::getDelimeter().$pictureName;
        if (file_exists( self::getImageFolder('save').$pId."/".$file )) {
            return self::getImageFolder('show').$pId."/".$file ."?update=".time();
        } else {
            return null;
        }
    }

    public static function updloadProductImages($pId, $files, $fromEtsy = false)
    {
        $names = [];
        $resultNames = [];
        $result = false;
        $folder = self::getImageFolder('save').$pId.'/';
        $imageTypes = self::imageTypes();
        $delimeter = self::getDelimeter();

        if(FileHelper::createDirectory($folder)){
            $result = true;
        }

        if (!$fromEtsy) {
            foreach ($files as $file) {
                $names[] = $file->name;
                $file->saveAs($folder . $file->name);
            }    
        } else {
            $names = $files;
        }
        H::ddd($names);
        $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET;
        Image::$thumbnailBackgroundColor = '#f5f5f5';

        foreach ($names as $name) {
            $newName = $pId.'_'.rand(1, 9999).'_'.rand(1,9999);
            $fileInfo = pathinfo($folder.$name);
            $resultNames[] = $newName.'.'.$fileInfo['extension'];
            foreach ($imageTypes as $size=>$values) {
                $fullName = $size.$delimeter.$newName.'.'.$fileInfo['extension'];                
                Image::thumbnail($folder.$name, $values['width'], $values['height'], $mode)
                    ->save($folder.$fullName, ['quality' => $values['quality']]);
            }

            // unlink($folder.$name);
        }

        return $resultNames;
    }

    public static function setMainImage($productId, $pictureId)
    {
        self::updateAll(['main'=>0], ['product_id'=>(int)$productId]);
        return self::updateAll(['main'=>1], ['id'=>(int)$pictureId]);
    }

    public static function deleteImage($productId, $pictureId)
    {
        $picture = self::find()->where(['product_id'=>(int)$productId, 'id'=>$pictureId])->one();

        if (!$picture) {
            return false;
        }

        return $picture->delete();
    }

    private function changeMainBeforeDelete()
    {
        $p = self::find()->where(['main'=>0, 'product_id'=>$this->product_id])->one();
        if ($p) {
            $p->main = 1;
            return $p->update();
        } else {
            $product = Product::findOne(['id'=>$this->product_id]);
            $product->has_images = Product::STATUS_NO_IMAGES;
            return $product->update();
        }
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        $this->deleteFile();
        return true;
    }


    public function deleteFile()
    {
        $folder = self::getImageFolder('save').$this->product_id.'/';
        $types  = self::imageTypes();
        foreach ($types as $type=>$sizes) {
            $fullFolder = $folder . $type . self::getDelimeter() . $this->name;
            if (file_exists($fullFolder)) {                
                unlink($fullFolder);
            }
        }
        
        if ($this->main == 1) {
            $this->changeMainBeforeDelete();
        }
    }

    public static function showNoImage()
    {
        return "/images/common/no_images_product.png";
    }
}

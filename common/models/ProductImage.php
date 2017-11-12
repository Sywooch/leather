<?php

namespace common\models;

use Yii;
use \yii\helpers\FileHelper;
use yii\imagine\Image;
use common\models\H;


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

    public static function updloadProductImages($pId, $files)
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

        foreach ($files as $file) {
            $names[] = $file->name;
            $file->saveAs($folder . $file->name);
        }

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

            unlink($folder.$name);
        }

        return $resultNames;
    }
}

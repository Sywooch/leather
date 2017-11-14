<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

use common\models\ProductInfo as Info;
use common\models\ProductImage as Images;
use common\models\H;
use common\models\ProductCategory as Category;
use common\models\Category as Categories;



class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_DELETED = 1;
    const IMAGE_DEFAULT_SIZE = 'md';
    const STATUS_NO_IMAGES = 0;
    const STATUS_HAS_IMAGES = 1;
    const STATUS_NO_CATEGORIES = 0;
    const STATUS_HAS_CATEGORIES = 1;

    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'timestamp'=>['class'=>\yii\behaviors\TimestampBehavior::className()],
        ];
    }

    public $files;
    public $categories = '';

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['price', 'active', 'delete', 'created_at', 'updated_at'], 'integer'],
            [['has_images', 'has_categories'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['categories',], 'string'],
            [['files'], 'file', 'maxFiles' => 0, 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function getInfo()
    {
        return $this->hasOne(Info::className(), ['product_id'=>'id']);
    }

    public function getCats()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])
                    ->viaTable('product_category', ['product_id' => 'id']);
    }

    public function getMainImage()
    {
        return $this->hasOne(Images::className(), ['product_id'=>'id'])->where(['main'=>1]);
    }

    public function getAllImages()
    {
        return $this->hasMany(Images::className(), ['product_id'=>'id'])->orderBy(['main'=>SORT_DESC]);
    }

    public function saveProduct()
    {
        $result = false;

        $categories         = Html::encode(trim($_POST['category']));
        $this->title        = Html::encode($this->title);
        $this->slug         = H::makeSlug($this->title);
        $this->delete       = self::STATUS_NOT_DELETED;
        $this->has_images   = (count($this->files) > 0) ? self::STATUS_HAS_IMAGES : self::STATUS_NO_IMAGES;

        if ($this->validate()) {
            $result = $this->save();
        } else {
            return false;
        }
        if (count($this->files) > 0 && $result = true) {
            $imageNames = Images::updloadProductImages($this->id, $this->files);
        
            for ($i=0; $i < count($imageNames); $i++) { 
                $main = $i == 0 ? 1 : 0;
                $picture = new Images(['product_id'=>$this->id, 'name'=>$imageNames[$i], 'main'=>$main]);
                $this->link('allImages', $picture);
            }
        }

        $info = new Info();
        $info->load(Yii::$app->request->post());
        $this->link('info', $info);

        $this->setCategories($categories);
        
        return $result;
    }

    public function updateProduct()
    {
        $categories     = Html::encode(trim($_POST['category']));
        $this->title    = Html::encode($this->title);
        $this->slug     = H::makeSlug($this->title);
        $this->delete   = self::STATUS_NOT_DELETED;
        if (count($this->files) > 0 && $this->has_images == self::STATUS_NO_IMAGES) {
            $this->has_images = self::STATUS_HAS_IMAGES;
        }

        $this->update();

        $hasPictures = false;
        if (count($this->mainImage)) {
            $hasPictures = true;
        }

        if (count($this->files) > 0) {
            $imageNames = Images::updloadProductImages($this->id, $this->files);
            for ($i=0; $i < count($imageNames); $i++) { 
                $main = ($i == 0 && !$hasPictures) ? 1 : 0;
                $picture = new Images(['product_id'=>$this->id, 'name'=>$imageNames[$i], 'main'=>$main]);
                $this->link('allImages', $picture);
            }
        }

        $this->info->load(Yii::$app->request->post());
        $this->info->update();

        $this->setCategories($categories);

        return true;
    }

    // Сохранение данных о выбранных категориях
    private function setCategories($string = '')
    {
        Category::deleteAll(['product_id'=>$this->id]);
        if ($string != '') {
            $catIds = explode(',', $string);
            $cat = new Category(['product_id'=>$this->id]);
            foreach ($catIds as $id) {
                $cat->category_id = (int)$id;
                $cat->isNewRecord = true;
                $cat->id = null;
                $cat->save();
            }
        }
        return true;
    }

    // Для админки. Выставление выбранных категорий в виджете
    public function setCategoryString()
    {
        $categories = Category::find()->where(['product_id'=>$this->id])->asArray()->all();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $this->categories .= $category['category_id'].',';
            }
        }
    }

    public function showImage($params = [])
    {
        $type = isset($params['type']) ? $params['type'] : self::IMAGE_DEFAULT_SIZE;
        $name = isset($params['name']) && $params['name'] != null ? $params['name'] : null;

        if ($name) {
            return Images::showImage($this->id, $name, $type);
        } else {
            return Images::showNoImage();
        }        
    }

    public function showMainImage($type = self::IMAGE_DEFAULT_SIZE)
    {
        if ($this->mainImage != null) {
            return Images::showImage($this->id, $this->mainImage->name, $type);
        } else {
            return Images::showNoImage();
        }
    }

    public static function findCondition($type, $params=[])
    {
        $array = [];
        switch ($type) {
            case 'admin':
                $array = [
                    'delete'=>self::STATUS_NOT_DELETED
                ];
            break;
            case 'front':
                $array = [
                    'delete'    => self::STATUS_NOT_DELETED,
                    'has_images'=> self::STATUS_HAS_IMAGES,
                    'active'    => self::STATUS_ACTIVE
                ];
            break;            
        }
        return $array;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->info->description;
    }

    public function getPrice()
    {
        return Yii::$app->formatter->asCurrency( $this->price );
    }

    public function getMaterials()
    {
        $result = [];
        if ($this->info != null && $this->info->materials != null) {
            $result = explode(',', $this->info->materials);
        }
        return $result;
    }

    public function getTags()
    {
        $result = [];
        if ($this->info != null && $this->info->tags != null) {
            $result = explode(',', $this->info->tags);
        }
        return $result;
    }

    public function isActive()
    {
        if ($this->active != self::STATUS_ACTIVE || $this->has_images == self::STATUS_NO_IMAGES) {
            return false;
        } else {
            return true;
        }
    }
}

<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Category;
use kartik\tree\TreeViewInput;
// use common\models\product\Product;
// use common\models\product\Status;

?>
<div class="row">
    <div class="col-md-9">
        <?= \common\widgets\Alert::widget() ?>        
    </div>
</div>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!-- Title -->
<div class="row">
    <div class="col-md-2">Название</div>
    <div class="col-md-10">
        <?= $form->field($product, 'title')->input(['placeholder'=>'Price'])->label(false) ?>
    </div>
</div>
<!-- Price -->
<div class="row">
    <div class="col-md-2">Стоимость ($)</div>
    <div class="col-md-3">
        <?= $form->field($product, 'price')->input('number', ['placeholder'=>'Price'])->label(false) ?>
    </div>
</div>
<!-- Active -->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <?= $form->field($product, 'active')
                ->checkbox(['itemOptions'=>['checked'=>true]])->label('Виден на сайте')
            ?>
    </div>
</div>
<!-- Descritption -->
<div class="row">
    <div class="col-md-2">Описание товара</div>
    <div class="col-md-10">
        <?= $form->field($info, 'description')->textArea(['class'=>'summernote', 'rows'=>20])->label(false) ?>
    </div>
</div>

<!-- Images -->
<div class="row">
    <div class="col-md-2">Изображения</div>
    <div class="col-md-10">
        <?= $form->field($product, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label(false) ?>
    </div>
    <?php if (!$product->isNewRecord && $product->allImages != null): ?>        
        <div class="col-md-10 col-md-offset-2">
            <?php foreach ($product->allImages as $image): ?>
                <div class="col-md-2" id="product-image-<?= $image->id ?>">
                    <?php $class = $image->main == 1 ? 'product-main-image' : ''; ?>
                    <img data-id="<?= $image->id ?>" src="<?= $product->showImage(['name'=>$image->name, 'type'=>'sm']) ?>" alt="" class="img-responsive img-thumbnail product-image-item <?= $class?> ">
                    <div class="text-center product-image-item-delete" data-id="<?= $image->id ?>">Delete</div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>

<!-- Categories -->
<div class="row">
    <div class="col-md-2">Категории товара</div>
    <div class="col-md-9">
         <?= 
            TreeViewInput::widget([
                // single query fetch to render the tree
                // use the Product model you have in the previous step
                'query'          => Category::find()->addOrderBy('root, lft'),
                'headingOptions' => ['label'=>''],
                'name'           => 'category', // input name
                'value'          => $product->categories !='' ? $product->categories : null,
                'asDropdown'     => false,
                'multiple'       => true,
                'fontAwesome'    => false,
                'rootOptions' => [
                    'label'=>'<i class="fa fa-tree"></i>',  // custom root label
                    'class'=>'text-success'
                ], 
                'options'=>['id'=>'category'],
            ]);
        ?>
    </div>
</div>


<!-- Tags -->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-9"></div>
</div>
<!-- Materials -->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-9"></div>
</div>

<?= Html::submitButton( $product->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
    

<?php ActiveForm::end(); ?>
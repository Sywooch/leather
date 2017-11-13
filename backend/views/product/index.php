<?php 
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<div class="row">
	<div class="col-md-12">
		<?= Html::a('Create', ['create'], ['class'=>'btn btn-link']) ?>
	</div>
</div>

<div class="row">
	<?php if (!empty($products)): ?>
		<?php foreach ($products as $product): ?>
			<div class="col-md-12">
				<div class="col-md-1">
					<img src="<?= $product->showMainImage('xs') ?>" alt="" class="img-responsive" >
				</div>
				<div class="col-md-4">
					<?= $product->title ?>
				</div>
				<div class="col-md-7">
					<?= Html::a('Update', ['update', 'id'=>$product->id], ['class'=>'btn btn-success']) ?>
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>
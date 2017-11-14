<?php 
	use yii\helpers\Html;
	use yii\helpers\Url;

	$this->params['breadcrumbs'][] = 'Все товары';
?>


<div class="row">
	<div class="col-md-12">
		<?= Html::a('Создать', ['create'], ['class'=>'btn btn-success btn-lg']) ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Title</th>
					<th>Active</th>
					<th>Price</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($products)): ?>
					<?php foreach ($products as $product): ?>
						<tr>
							<td><img src="<?= $product->showMainImage('xs') ?>" alt="" class="img-responsive img-thumbnail" style="max-width: 150px; max-height: 150px;"></td>
							<td><?= Html::a($product->getTitle(), ['update', 'id'=>$product->id]) ?></td>
							<td><?= $product->isActive() ? 'Active' : 'Hidden' ?></td>
							<td><?= $product->getPrice() ?></td>
							<td><?= Html::a('Update', ['update', 'id'=>$product->id], ['class'=>'btn btn-success']) ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
		</div>
	</div>	
</div>
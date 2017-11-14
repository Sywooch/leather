<?php 
	$this->params['breadcrumbs'][] = ['url'=>['product/index'], 'label'=>'Все товары'];  
	$this->params['breadcrumbs'][] = 'Обновление';  
?> 
<?= $this->render('_form', compact('product', 'info')) ?>
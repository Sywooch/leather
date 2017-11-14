<?php 
	$this->params['breadcrumbs'][] = ['url'=>['product/index'], 'label'=>'Все товары'];  
	$this->params['breadcrumbs'][] = 'Создание';  
?> 
<?= $this->render('_form', compact('product', 'info')) ?>
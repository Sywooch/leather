<?php

use kartik\tree\TreeView;
use kartik\tree\TreeViewInput;
use common\models\Category;

?>

<div class="row">
    <div class="col-md-12">
        <?= 
            TreeView::widget([
                // single query fetch to render the tree
                // use the Product model you have in the previous step
                'query' => Category::find()->addOrderBy('root, lft'), 
                'headingOptions' => ['label' => 'Categories'],
                'fontAwesome' => false,     // optional
                'isAdmin' => true,         // optional (toggle to enable admin mode)
                'displayValue' => 1,        // initial display value
                'softDelete' => false,       // defaults to true
                'cacheSettings' => [        
                    'enableCache' => false   // defaults to true
                ],
                 'nodeAddlViews' => [
                    // \kartik\tree\Module::VIEW_PART_4 =>  '@backend/views/category/_description',
                ]
            ]);
        ?>        
    </div>
        
</div>
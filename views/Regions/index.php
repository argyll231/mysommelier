<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\RegionsSearch $searchModel
 */

$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Regions', ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php 
		Pjax::begin(); 
		echo GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				[
					'attribute' => 'country',
					'value' => 'country',
					'hAlign' => GridView::ALIGN_CENTER,
					'width' => '90px',
					'filterType' => GridView::FILTER_SELECT2,
					'filter' => Yii::$app->params['wine_countries'],
					'filterWidgetOptions' => [
						'pluginOptions' => [
							'allowClear' => true,
							'width' => '150px',
						],
					],
					'filterInputOptions' => [
						'placeholder' => 'All Countries'
					],
				],
				'region_name',
				[
					'class' => 'yii\grid\ActionColumn',
					'buttons' => [
						'update' => function ($url, $model) {
										return Html::a(
											'<span class="glyphicon glyphicon-pencil"></span>', 
											Yii::$app->urlManager->createUrl(['regions/view','id' => $model->id,'edit'=>'t']), 
											[
												'title' => Yii::t('yii', 'Edit'),
											]);
									}
					],
				],
			],
			'responsive'=>true,
			'hover'=>true,
			'condensed'=>true,
			'floatHeader'=>true,
			'panel' => [
				'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
				'type'=>'info',
				'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Region', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
				'showFooter'=>false
			],
		]); 
		Pjax::end(); 
	?>

</div>

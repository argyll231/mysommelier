<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\models\Regions;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AppellationsSearch $searchModel
 */

$this->title = 'Appellations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appellations-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Appellations', ['create'], ['class' => 'btn btn-success'])*/  ?>
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
				[
					'attribute' => 'region_id',
					'header' => 'Region',
					'value' => 'region.region_name',
					'width' => '200px',
					'filterType' => GridView::FILTER_SELECT2,
					'filter' =>
						ArrayHelper::map(Regions::find()
							->orderBy('region_name')
							->asArray()
							->all(),
							'id', 'region_name'
						),
					'filterWidgetOptions' => [
						'pluginOptions' => [
							'allowClear' => true,
							'width' => '200px',
						],
					],
					'filterInputOptions' => [
						'placeholder' => 'Any region'
					],
				],
				'app_name',
				'common_flg',
				[
					'class' => 'kartik\grid\ActionColumn',
					'width' => '70px',
					'buttons' => [
						'update' => 
							function ($url, $model) {
								return Html::a(
									'<span class="glyphicon glyphicon-pencil"></span>', 
									Yii::$app->urlManager->createUrl(
										[
											'appellations/view',
											'id' => $model->id,
											'edit'=>'t'
										]
									), 
									[
										'title' => Yii::t('yii', 'Edit'),
									]
								);
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
				'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
				'showFooter'=>false
			],
		]); 
		Pjax::end(); 
	?>
</div>

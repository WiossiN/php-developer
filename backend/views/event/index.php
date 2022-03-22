<?php

use common\models\Event;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            'goal',
                            'cost',
                            'endpoint',
                            [
                                'attribute' => 'status',
                                'filter' => Event::getStatusOptions(),
                                'content' => function ($data) {
                                    return $data->getStatusName();
                                },
                            ],
                            'created_at:datetime',
                            'updated_at:datetime',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{sending}<br>{view} {update} {delete}',
                                'buttons' => [
                                    'sending' => function ($url, $data) {
                                        if ($data->status !== 'confirmed')
                                            return Html::a('Подтвердить', $url, ['data-method' => 'POST']);
                                    },
                                ],
                            ],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>

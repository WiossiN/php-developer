<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Endpoint */

$this->title = 'Create Endpoint';
$this->params['breadcrumbs'][] = ['label' => 'Endpoints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

use common\models\Endpoint;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="event-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'endpoint')->dropDownList(ArrayHelper::map(Endpoint::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

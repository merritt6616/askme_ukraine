<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'answer_name')->textInput(['maxlength' => true, 'autofocus'=>'autofocus']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn--responsive--block' : 'btn btn--responsive--block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

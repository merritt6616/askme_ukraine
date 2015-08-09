<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'question_name')->textInput(['maxlength' => true, 'autofocus'=>'autofocus']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn--responsive--block' : 'btn btn--responsive--block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

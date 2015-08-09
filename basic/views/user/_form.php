<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'user_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_isMaster')->checkbox(['uncheck'=>0]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn--responsive--block' : 'btn btn--responsive--block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

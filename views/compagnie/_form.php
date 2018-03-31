<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Compagnie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compagnie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'compagnia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indirizzo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cellulare')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'utente_id')->textInput() ?>

    <?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

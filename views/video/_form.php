<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'video_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'durata')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'compagnia_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visite')->textInput() ?>

    <?= $form->field($model, 'data_pubblicazione')->textInput() ?>

    <?= $form->field($model, 'mi_piace')->textInput() ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

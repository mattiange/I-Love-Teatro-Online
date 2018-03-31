<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Utenti;

$utenti = new Utenti();

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>-->
    
    <?= $form->field($model, 'user_id')->dropDownList(
            ArrayHelper::map($utenti::find()->all(),'id','email'))?> 
    
    <p>
        <?= Html::input('text', 'notuse', Yii::$app->formatter->asDate($model->created_at, 'd-M-Y'), ['class' => 'form-control', 'disabled' => 'disabled']) ?>
    </p>
    
    <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

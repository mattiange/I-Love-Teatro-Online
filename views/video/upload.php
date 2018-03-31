<?php
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Carica il video');
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>

<?php ?>
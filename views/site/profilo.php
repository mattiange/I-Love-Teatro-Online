<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = $utente->nome." ".$utente->cognome;
?>
<div id="profilo" class="profilo">
    <h1><?= $this->title ?> <small>#<?= $utente->id ?></small></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($utente, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($utente, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($utente, 'email')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($utente, 'password')->passwordInput(['maxlength' => true, 'value'=>'']) ?>-->
    
    <div class="form-group field-utenti-password">
        <label class="control-label" for="pswd">
            Password
        </label>
        <?= Html::input('password', 'pswd', '', [
            'id' => 'utenti-pswd',
            'class' => 'form-control']); ?>
        <div class="col-lg-12">
            <div class="help-block help-block-error"></div>
        </div>
    </div>
    
    <div class="form-group field-utenti-confermapswd">
        <label class="control-label" for="confermapswd">
            Conferma la password
        </label>
        <!--<div>-->
        <?= Html::input('password', 'confermapswd', '', [
            'id' => 'utenti-confermapswd',
            'class' => 'form-control']); ?>
        <!--</div>-->
        <div class="col-lg-12">
            <div class="help-block help-block-error"></div>
        </div>
    </div>

    <?= $form->field($utente, 'indirizzo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($utente, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($utente, 'authkey')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Aggiorna i dati', ['class' => 'btn btn-primary', 'name' => 'utente-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs(
    "jQuery('#profilo [type=\'password\']').removeAttr('aria-required');
    jQuery('[name=\'utente-button\']').click(function() {
        var password = jQuery('#utenti-pswd').val();
        var conferma = jQuery('#utenti-confermapswd').val();
        
        //Controllo se le password corrispondono
        if(password != conferma){
            jQuery('.field-utenti-confermapswd').toggleClass('has-success');
            jQuery('.field-utenti-confermapswd').toggleClass('has-error');
            
            jQuery('.field-utenti-confermapswd.has-error .help-block').text('Le password non corrispondono');
            
            event.preventDefault();
        }else{
            jQuery('#registrati-form').submit();
        }
     });"
);
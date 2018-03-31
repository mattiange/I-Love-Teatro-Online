<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$title2 = 'Iscriviti per votare';
?>
<div class="site-registrati-utente">
    <h1><?= Html::encode($title2) ?></h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'registrati-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div>{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    
    <?= $form->field($utenti, 'nome')->input('cognome') ?>
    <?= $form->field($utenti, 'cognome')->input('cognome') ?>
    <?= $form->field($utenti, 'email')->input('email') ?>
    <?= $form->field($utenti, 'password')->input('password') ?>
    <div class="form-group field-utenti-confermapswd required">
        <label class="control-label" for="confermapswd">
            Conferma la password
        </label>
        <div>
        <?= Html::input('password', 'confermapswd', '', [
            'id' => 'utenti-confermapswd',
            'class' => 'form-control', 'required' => 'required']); ?>
        </div>
        <div class="col-lg-12">
            <div class="help-block help-block-error"></div>
        </div>
    </div>
    <?= $form->field($utenti, 'indirizzo')->input('indirizzo') ?>
    <?= $form->field($utenti, 'telefono')->input('telefono') ?>
    
    <?= $form->field($auth, 'item_name')->hiddenInput(['value'=>'User'])->label(false) ?>
    
    <div class="form-group">
        <div>
            <?= Html::submitButton('Registrati', ['class' => 'btn btn-primary', 'name' => 'utente-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs(
    "jQuery('[name=\'utente-button\']').click(function() {
        var password = jQuery('#utenti-password').val();
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
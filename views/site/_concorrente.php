<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$title2 = 'Iscriviti al concorso';
?>

<div class="site-registrati-utente">
    <h1><?= Html::encode($title2) ?></h1>
    <h3>Dati dell'intestatario</h3>
    
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
    
    <h3>Dati della compagnia</h3>
    
    <?= $form->field($compagnie, 'compagnia')->input('compagnia') ?>
    <?= $form->field($compagnie, 'indirizzo')->input('indirizzo') ?>
    <?= $form->field($compagnie, 'telefono')->input('telefono') ?>
    <?= $form->field($compagnie, 'email')->input('email') ?>
    
    <?= Html::input('hidden', 'registrati-utente', 'true') ?>
    
    
    <?= $form->field($auth, 'item_name')->hiddenInput(['value'=>'Video Publisher'])->label(false) ?>
    <?= $form->field($auth, 'user_id')->hiddenInput(['value'=>29])->label(false) ?>
    <!--<?= $form->field($auth, 'created_at')->hiddenInput(['value'=> strtotime('now')])->label(false) ?>-->
    
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
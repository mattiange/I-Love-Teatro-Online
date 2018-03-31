<?php
/**
 * Pagina di visualizzazione della compagnia
 * 
 * @var app\models\Compagnia $compagnia
 */
use app\models\Utenti;

$utente = Utenti::findByID($compagnia->utente_id);

$this->title = Yii::t('app', $compagnia->compagnia);
?>
<h1><?= $this->title ?></h1>

<div id="compagnia">
    <div class="wrapper compagnia">
        <div class="utente-nomecognome">
            <div class="f-left"><?= Yii::t('app', 'Rappresentante legale') ?></div>
            <div class="f-left"><strong><?= $utente->nome?>&nbsp;<?= $utente->cognome ?></strong></div>
        </div>
        <div class="compagnia-email">
            <div class="f-left"><?= Yii::t('app', 'Email della compagnia') ?></div>
            <div class="f-left"><strong><?= $utente->email ?></strong></div>
        </div>
        <div class="compagnia-">
            <div class="f-left"><?= Yii::t('app', 'Sede legale') ?></div>
            <div class="f-left"><strong><?= $compagnia->indirizzo ?></strong></div>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Utenti */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Utenti',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utentis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="utenti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Compagnie */

$this->title = Yii::t('app', 'Create Compagnie');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compagnies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compagnie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

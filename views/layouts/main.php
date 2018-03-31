<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\rbac\DbManager;
use app\models\Utenti;

$utenti = new Utenti();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<div class="title-container">
                            <div class="title">I Love Teatro Online</div>
                            <div class="subtitle"><small>di</small>Teatralmente Gioia</div>
                        </div>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
            'id' => 'mainmenu'
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Iscriviti', 'items' => [
                    ['label' => 'Iscriviti al concorso', 'url' => ['site/registrati_concorso']],
                    ['label' => 'Iscriviti come votante', 'url' => ['site/registrati']]
                ]]
            ) : '',
            Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                    [
                        'label' => Yii::$app->user->identity->nome,
                        'items' => [
                            ['label' => 'Profilo', 'url' => ['site/profilo', 'id'=>Yii::$app->user->id]],
                            ['label' => 'I miei voti', 'url' => ['site/voti']],
                            !Yii::$app->user->can('Video Publisher') ? '' : (
                                    ['label' => 'Video', 'url' => ['video/index']]
                            ),
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                Yii::t('app', 'Esci'),
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                        ]
                    ]
            ),
            /*Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::$app->user->identity->nome,
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )*/
        ],
    ]);
    NavBar::end();
    ?>

    <div class="body container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="row">
        <div class="col-sm-4">
            <div class="container">
                <p>&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
            </div>
        </div>
        
        <div class="col-sm-4">
            <ul class="list ls-none">
                <li><a href="">Contattaci</a></li>
            </ul>
        </div>
        
        <div class="col-sm-4">
            SOCIAL
        </div>
    </div>
</footer>
    
    
<?php
$this->registerJs(
        "jQuery(document).ready(function(){
            /*jQuery('.navbar .dropdown .dropdown-toggle').click(function(){
                alert(jQuery(this).attr('class'));
                jQuery(this).parent().removeClass('open');
                jQuery(this).attr('aria-expanded', 'false');
            });*/
            
            jQuery('.navbar .dropdown .dropdown-toggle').click(false);
        });"
);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

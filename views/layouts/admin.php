<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\AuthAssignment;
use yii\rbac\DbManager;

//Gestione dei permessi degli utenti
$auth = new DbManager;
$auth->init();

$auth_assignment = new AuthAssignment();
//$auth_assignment->user_id = Yii::$app()->user->getId();
//Yii::$app->authManager->getAuthItems(2, Yii::$app->user->getId());
//Yii::$app->user->can('Super User');

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
    
    <?php
    if(!Yii::$app->user->isGuest){
        $userAssigned = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        
        foreach ($userAssigned as $rule => $value){
            if($rule == 'Super User'){
                include_once '_menuSuperUser.php';
            }else if($rule == 'Compagnie'){
                include_once '_menuCompagnie.php';
            }else{
                include_once '_menuUtente.php';
            }
        }
        
        /*foreach($userAssigned as $userAssign){
            if($userAssign->roleName == 'Super User'){
                include_once '_menuSuperUser.php';
            }else if($userAssign->roleName == 'Utente'){
                include_once '_menuCompagnie.php';
            }else{
                include_once '_menuUtente.php';
            }
        }*/
    }
    ?>

    <div class="container f-left admin-content">
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
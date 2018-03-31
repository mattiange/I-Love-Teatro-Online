<?php
use yii\helpers\Url;
use app\models\Compagnie;
use app\models\MiPiace;
use app\models\Video;

$cont = 1;
$this->title = "I Love Teatro";
?>

<?php if(Yii::$app->request->get('flag')==true) : ?>
<div class="alert alert-success">
    Account creato con successo. <br />
    Ti abbiamo inviato un'email con i dati di riepilogo. <br />
    
    <a href="<?= Url::to(['site/login'])?>">Accedi</a>
</div>
<?php endif; ?>

<?php if(count($video) == 0): ?>
    <p class="alert alert-warning">NESSUN VIDEO CARICATO</p>
<?php else: ?>
    <div id="video-index" class="o-hidden">
    <?php foreach ($video as $key => $value) : ?>
        <div class="col f-left">
            <div class="wrapper">
                <a href="<?= Url::to(['site/video', 'id'=>$value->id]) ?>">
                    <div class="cover">
                        <video>
                            <source src="<?= Yii::getAlias('@web') ?>/uploads/<?= $value->video_url ?>"
                                    type="<?= $value->type ?>" />
                        </video>
                    </div>
                </a>
                
                <div class="title">
                    <a href="<?= Url::to(['site/video', 'id'=>$value->id]) ?>">
                        <h3 class="f-left"><?= $value->titolo ?></h3>
                    </a>
                </div>
                
                <div class="meta">
                    <div class="author">
                        Autore: 
                        <a href="<?= Url::to(['site/compagnia', 'id'=>Compagnie::findById($value->compagnia_id)->id]) ?>">
                            <strong><?= Compagnie::findById($value->compagnia_id)->compagnia ?></strong>
                        </a>
                    </div>
                    <div class="views">
                        Visite: <strong><?= $value->visite ?></strong>
                    </div>
                    <div class="published">
                        Pubblicato il: <strong><?= $value->data_pubblicazione ?></strong>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif;?>
<!--
<?php foreach($video as $key => $value) : ?>
    <div class="container">
      <div class="row">
        <div class="col-sm">
            <div class="wrapper">
                <div class="cover">
                    <video width="100%" height="100%">
                        <source src="<?= Yii::getAlias('@web') ?>/uploads/<?= $value->video_url ?>"
                                type="<?= $value->type ?>" />
                    </video>
                </div>

                <div class="title o-hidden">
                    <h3 class="f-left">
                        <a href="<?= Url::to(['site/video', 'id'=>$value->id]) ?>">
                            <?= $value->titolo ?>
                        </a>
                    </h3>

                    <div class="like-box f-right<?= (count(MiPiace::findById(Yii::$app->user->id, $value->id))>0)?' unlike':'' ?>" data-action="like" 
                            data-video-id="<?= $value->id ?>"
                            data-user-id="<?= Yii::$app->user->id ?>">
                           <?= Video::getMiPiace($value->id) ?>
                    </div>
                </div>

                <div class="meta">
                    <div class="author">
                        Autore: <strong><?= Compagnie::findById($value->compagnia_id)->compagnia ?></strong>
                    </div>
                    <div class="views">
                        Visite: <strong><?= $value->visite ?></strong>
                    </div>
                    <div class="published">
                        Pubblicato il: <strong><?= $value->data_pubblicazione ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--<?php endforeach; ?>
-->
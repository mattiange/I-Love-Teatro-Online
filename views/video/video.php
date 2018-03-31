<?php
/**
 * PAGINA DI GESTIONE DEL VIDEO PUBBLICATO DALL'UTENTE
 * 
 * @var $model app/models/Video
 */


use app\models\Video;
use app\models\Compagnie;
use app\models\MiPiace;
use yii\helpers\Url;

$video = Video::findByCompagniaId(Compagnie::findByUtenteId(Yii::$app->user->id));

$this->title = "Il mio video";
?>
<h1 class="video-title"><?= Yii::t('app', $this->title) ?></h1>

<div id="video" class="video">
    <div class="video-cover">
        <div class="video">
            <video controls>
                <source src="<?= Yii::getAlias('@web') ?>/uploads/<?= $video->video_url ?>" type="<?= $video->type ?>">
            </video>
        </div>
    </div>

    <div class="video-social o-hidden c-both">
        <div class="social f-left">
            <div class="fb-share-button" 
                 data-href="https://www.teatralmentegioia.it/concorso/web/index.php?r=site%2Fvideo&amp;id=<?= $video->id ?>" 
                    data-layout="button_count" data-size="small" 
                    data-mobile-iframe="true">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.teatralmentegioia.it%2Fconcorso%2Fweb%2Findex.php%3Fr%3Dsite%252Fvideo%26id%3D<?= $video->id ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                    Condividi
                </a>
            </div>
            
            <a class="twitter-share-button"
                href="<?= Yii::getAlias('@web') ?>"
                data-size="default">
              Tweet
            </a>
            
            <!-- Inserisci questo tag nel punto in cui vuoi che sia visualizzato l'elemento pulsante Condividi. -->
            <div class="g-plus" data-action="share"></div>
        </div>
    
        <div class="meta">
            <div class="author">
                <?= Yii::t('app', 'Autore') ?>:
                <a href="<?= Url::to(['site/compagnia', 'id'=>Compagnie::findById($video->compagnia_id)->id]) ?>">
                    <strong><?= Compagnie::findById($video->compagnia_id)->compagnia ?></strong>
                </a>
            </div>
            <div class="views">
                Visite: <strong><?= $video->visite ?></strong>
            </div>
            <div class="published">
                Pubblicato il: <strong><?= $video->data_pubblicazione ?></strong>
            </div>
        </div>
        
        
        <!--<div class="like-box f-right<?= (count(MiPiace::findById(Yii::$app->user->id, $video->id))>0)?' unlike':'' ?>" data-action="like" 
             data-video-id="<?= $video->id ?>"
             data-user-id="<?= Yii::$app->user->id ?>">
            <?= Video::getMiPiace($video->id) ?>
        </div>-->
    </div>

    <div class="video-description"><?= $video->descrizione ?></div>
</div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.12&appId=290090058168324&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>

<!-- Posiziona questo tag all'interno del tag head oppure subito prima della chiusura del tag body. -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'it'}
</script>


<?php
$this->registerJsFile("https://code.jquery.com/ui/1.12.1/jquery-ui.js",  [
    'depends' => [yii\web\JqueryAsset::className()]
]);
$script = <<< JS
    jQuery(document).ready(function (){
        jQuery("#video").video_player({
        });
    });
JS;

$this->registerJs($script);
?>
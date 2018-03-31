<?php
/**
 * Pagina di visualizzazione del video selezionato dall'utente
 */


/**
 * MODIFICARE E ULTIMARE CONDIVISIONE SOCIAL
 * 
 * AGGIUNGERE CREAZIONE AUTOMATICA TINY URL QUANDO VIENE CARICATO UN VIDEO
 */
use app\models\Video;
use app\models\MiPiace;
use app\models\Compagnie;
use yii\helpers\Url;

//Video da visualizzare
$video = Video::findById(Yii::$app->request->get('id'));

$this->title = Yii::t('app', $video->titolo);
?>
<h1 class="video-title"><?= $this->title ?></h1>

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
            <a href="http://www.facebook.com/sharer.php?u=<?= Yii::$app->getRequest()->serverName ?>/<?= Url::current() ?>&t=<?= $this->title ?> ?>">
                <img src="<?= Yii::getAlias('@web');?>/images/ico/24x24/png/facebook24x24.png" 
                     alt="Add to FaceBook" />
            </a>
            <a href="http://twitter.com/home?status=LINK_SHORT">
                <img src="http://www.PerlitaLabs.com/Social_Bookmark_Builder_1_2/icons/24/twitter.png" alt="Add to Twitter" />
            </a>
            
            <!--<div class="fb-share-button" 
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
            <!--<div class="g-plus" data-action="share"></div>-->
        </div>
        
        <?php if(!Yii::$app->user->isGuest): ?>
        <div class="like-box f-right<?= (count(MiPiace::findById(Yii::$app->user->id, $video->id))>0)?' unlike':'' ?>" data-action="like" 
             data-video-id="<?= $video->id ?>"
             data-user-id="<?= Yii::$app->user->id ?>">
            <?= Video::getMiPiace($video->id) ?>
        </div>
        <?php endif; ?>
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

    <div class="video-description"><?= $video->descrizione ?></div>
</div>




<?php //Aggiunta dei social (FB, Twitter, Google+) ?>
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
$url = Yii::$app->getUrlManager()->getBaseUrl();
$this->registerJsFile("https://code.jquery.com/ui/1.12.1/jquery-ui.js",  [
    'depends' => [yii\web\JqueryAsset::className()]
]);
$script = <<< JS
    jQuery(document).ready(function (){
        jQuery("#video").video_player({
        });
    });
    
    
    
    var ajax = assegnaXMLHttpRequest();
    
    if(ajax){
        jQuery(".like-box[data-action=\"like\"]").click(function (){
            var _this = this;
            var data = {
                idv : jQuery(this).attr('data-video-id'), //ID video
                idu : jQuery(this).attr('data-user-id')  //ID utente
            };
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                data : data,
                url : "{$url}/js/mi_piace.php",//Link del video
                success: function (data, stato){
                    if(data==="false"){
                        alert("Al momento non è possibile votare, si pega di riprovare più tardi!");
                    }else{
                        jQuery(_this).toggleClass("unlike");
                        jQuery(_this).text(data);
                    }
                },
                error: function (richiesta, stato, errori){
                    alert("Al momento non è possibile votare, si pega di riprovare più tardi!");
                }
            });
        });
    }
    
    /**
     * Controllo InternetExplorer
     * 
     * @returns {ActiveXObject|XMLHttpRequest}
     */
    function assegnaXMLHttpRequest(){
        var XHR = null,
            browserUtente = navigator.userAgent.toUpperCase();
    
        if(typeof (XMLHttpRequest) === "function" || typeof (XMLHttpRequest) == "object"){
            XHR = new XMLHttpRequest();
        }else if(window.ActiveXObject && browserUtente.indexOf("MSIE 4") < 0){
            if(browserUtente.indexOf("MSIE 5") < 0){
                XHR = new ActiveXObject("Msxml2.XMLHTTP");
            }else{
                XHR = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        
        return XHR;
    }
JS;

$this->registerJs($script);
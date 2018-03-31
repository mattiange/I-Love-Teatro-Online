<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Video;
use app\models\Utenti;
use app\models\Compagnie;
use app\models\AuthAssignment;
use app\models\MiPiace;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
        
        $video = Video::find()->all();
        
        
        
        //$this->registerJsFile('@web/js/specific.js');
        
        //Visualizza la pagina iniziale se si è loggati
        return $this->render('index', [
            'video' => $video,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {            
            $this->layout = 'admin';
            
            
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Registrazione utente votante
     * 
     * @return type
     */
    public function actionRegistrati(){
        $utenti = new Utenti();
        $compagnie = new Compagnie();
        $authAssignment = new AuthAssignment();
        
        
        if($utenti->load(Yii::$app->request->post())){
            $utenti->password = md5($utenti->password);
            
            if($utenti->save()){
                $authAssignment->user_id = "$utenti->id";
                $authAssignment->created_at = time();
                
                if($authAssignment->load(Yii::$app->request->post()) && $authAssignment->save()){
                    $content = "Grazie per esserti registrato su <strong>I Love Teatro Online</strong><br /><r />
                    <ul>
                        <li>Nome: ".Yii::$app->request->post('Utenti')['nome']."</li>
                        <li>Cognome: ".Yii::$app->request->post('Utenti')['cognome']."</li>
                        <li>email: ".Yii::$app->request->post('Utenti')['email']."</li>
                        <li>password: ".Yii::$app->request->post('Utenti')['password']."</li>
                        <li>Indirizzo: ".Yii::$app->request->post('Utenti')['indirizzo']."</li>
                    </ul>";

                    Yii::$app->mailer->compose(['html'=>'html', 'text'=>'text'],['content'=>$content])
                            ->setFrom(['iscrizioni.iloveteatro@teatralmentegioia.it'=>'Teatralmente Gioia | I Love Teatro'])
                            ->setTo(Yii::$app->request->post('Utenti')['email'])
                            ->setSubject('Oggetto')
                            ->send();
                    
                    $this->redirect(['site/registrazione_success']);
                }
            }
            
            return $this->render('registrati',
                [
                    'utenti' => $utenti,
                    'compagnie' => $compagnie,
                    'auth' => $authAssignment,
                    'error' => true,
                ]
            );
        }
        
        return $this->render('registrati',
            [
                'utenti' => $utenti,
                'compagnie' => $compagnie,
                'auth' => $authAssignment,
            ]
        );
    }
    
    /**
     * Registrazione concorrente.
     *
     * @return string
     */
    public function actionRegistrati_concorso(){
        $utenti = new Utenti();
        $compagnie = new Compagnie();
        $authAssignment = new AuthAssignment();
        
        if($utenti->load(Yii::$app->request->post())){
            $utenti->password = md5($utenti->password);
            
            if($compagnie->load(Yii::$app->request->post()) && $utenti->save()){
                $compagnie->utente_id = $utenti->id;
                
                $compagnie->save();
                $authAssignment->load(Yii::$app->request->post());
                $authAssignment->user_id = "$utenti->id";
                
                $authAssignment->save();
            }
            $post = Yii::$app->request->post();

            $content = "Grazie per esserti registrato al concorso <strong>I Love Teatro Online</strong><br /><r />
                    <ul>
                        <li>Nome: ".Yii::$app->request->post('Utenti')['nome']."</li>
                        <li>Cognome: ".Yii::$app->request->post('Utenti')['cognome']."</li>
                        <li>email: ".Yii::$app->request->post('Utenti')['email']."</li>
                        <li>password: ".Yii::$app->request->post('Utenti')['password']."</li>
                        <li>Compagnia: ".Yii::$app->request->post('Compagnie')['compagnia']."</li>
                        <li>Indirizzo della compagnia: ".Yii::$app->request->post('Compagnie')['indirizzo']."</li>
                        <li>Tel. della compagnia: ".Yii::$app->request->post('Compagnie')['telefono']."</li>
                        <li>Email della compagnia: ".Yii::$app->request->post('Compagnie')['email']."</li>
                    </ul>";

            Yii::$app->mailer->compose(['html'=>'html', 'text'=>'text'],['content'=>$content])
                    ->setFrom(['iscrizioni.iloveteatro@teatralmentegioia.it'=>'Teatralmente Gioia | I Love Teatro'])
                    ->setTo(Yii::$app->request->post('Utenti')['email'])
                    ->setSubject('Oggetto')
                    ->send();
            
            $this->redirect(['site/index', 'flag'=>$flag=true]);
        }
        
        return $this->render('registrati_concorso',
            [
                'utenti' => $utenti,
                'compagnie' => $compagnie,
                'auth' => $authAssignment,
            ]
        );
    }
    
    /**
     * Messaggio di avvenuta registrazione
     * 
     * @return type
     */
    public function actionRegistrazione_success(){
        return $this->render('registrazione_success');
    }
    
    /**
     * Visualizza il video selezionato dall'utente e 
     * aggiorna il numero di visite del video
     * 
     * @return string
     */
    public function actionVideo(){
        //$user_ip = Yii::$app->request->userIP;
        
        if(!Yii::$app->user->can('Super User')){
            $video_id = Yii::$app->request->get('id');

            $video = Video::findById($video_id);
            $video->visite+=1;

            $video->save();
        }else{
            $this->layout = 'admin';
        }
       
        return $this->render('video');
    }
    
    /**
     * Visualizza i dati della compagnia
     * 
     * @return string
     */
    public function actionCompagnia(){        
        $compagnia = Compagnie::findById(Yii::$app->request->get('id'));
        
        if(Yii::$app->user->can('Super User')){
            $this->layout = 'admin';
        }
       
        
        return $this->render('compagnia', [
            'compagnia' => $compagnia,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $this->layout = 'main';

        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Profilo utente
     */
    public function actionProfilo(){
        $utente = Utenti::findByID(Yii::$app->user->id);
        
        if($utente->load(Yii::$app->request->post()) && $utente->save()){
            $content = "I tuoi dati sono stati modificati con successo</strong><br /><r />
                    <ul>
                        <li>Nome: ".Yii::$app->request->post('Utenti')['nome']."</li>
                        <li>Cognome: ".Yii::$app->request->post('Utenti')['cognome']."</li>
                        <li>email: ".Yii::$app->request->post('Utenti')['email']."</li>
                        <li>password: ".Yii::$app->request->post('Utenti')['password']."</li>
                        <li>Indirizzo: ".Yii::$app->request->post('Utenti')['indirizzo']."</li>
                    </ul>";

            Yii::$app->mailer->compose(['html'=>'html', 'text'=>'text'],['content'=>$content])
                    ->setFrom(['iscrizioni.iloveteatro@teatralmentegioia.it'=>'Teatralmente Gioia | I Love Teatro'])
                    ->setTo(Yii::$app->request->post('Utenti')['email'])
                    ->setSubject('Oggetto')
                    ->send();
            
            
            return $this->redirect(['profilo', 'id' => $utente->id]);
        }
        
        return $this->render('profilo', [
            'utente' => $utente,
        ]);
    }
    
    /**
     * 
     * @return type
     */
    public function actionVoti(){
        $mi_piace = MiPiace::find()->where('utente_id='.Yii::$app->user->id)->all();
        $video = array();
        
        foreach ($mi_piace as $val){
            $tmp = Video::findById($val->video_id);
            $video[] = $tmp;
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $video,
            
            'sort' => [
                'attributes' => ['id', /*'compagnia_id', 'video_url',*/ 'mi_piace'],
            ],
        ]);
        
        return $this->render('voti', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    /*public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }*/
}

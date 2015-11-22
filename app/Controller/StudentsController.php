<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class StudentsController extends AppController {
	var $uses = array('Student');

	public $components = array(
        'Session',
		'Cookie',
        'Auth' => array(
			'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Student',
                    'fields' => array('username' => 'student_name','password' => 'password')
					//2つで認証する場合、usernameとpasswordに対応するものが何かを明示する必要がある
                )
            
			),
            // ログイン後にジャンプ
            'loginRedirect' => array('controller' => 'Students', 'action' => 'student_edit'),
			//array('action'=>'edit',$data['User']['id'])
            // ログアウト後に /circles/circle_login へジャンプ
            'logoutRedirect' => array('controller' => 'Students', 'action' => 'studnet_login'))
        );
 
    public function beforeFilter() {
        // 各コントローラーの index と login を有効にする
        $this->Auth->allow('circle','home','student','link','student_login','student_tw_callback','about','recruit','student_login','student_resister','student_edit','student_tw_logout');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.students';
    }
	public function student_tw_callback(){
		//ユーザー認証をする関数
		require_once('config.php');
		require_once('codebird.php');
		session_start();
		

		\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
		$cb = \Codebird\Codebird::getInstance();

		if (! isset($_SESSION['oauth_token'])) { //まだデータが渡されていないときは（認証前）
		// get the request token
		$reply = $cb->oauth_requestToken([
			'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		]);
    
		// store the token
		$cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
		$_SESSION['oauth_token'] = $reply->oauth_token;
		$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		$_SESSION['oauth_verify'] = true;

		// redirect to auth website
		$auth_url = $cb->oauth_authorize(); //Twitterの認証画面に飛ばしている
		header('Location: ' . $auth_url);
		die();

		} elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
			// verify the token
			$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			unset($_SESSION['oauth_verify']);

			// get the access token
			$reply = $cb->oauth_accessToken([
				'oauth_verifier' => $_GET['oauth_verifier']
			]);
			// store the token (which is different from the request token!)
			//$_SESSION['oauth_token'] = $reply->oauth_token;
			//$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
			$cb->setToken($reply->oauth_token,$reply->oauth_token_secret);
			$me = $cb->account_verifyCredentials(); //$meの中にアカウントの情報を入れる

			//データベースにアカウント情報を格納
			try{ //まずはデータベースに接続
				$dbh = new PDO('mysql:host=127.0.0.1;dbname=circlerecommend;charset=utf8','root','');
			}catch(PDOException $e){
				echo $e->getMessage();
			exit;
			}
    
			$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
			$user = $stmt->fetch(); //結果を返す 
			if(!$user){ //取得したユーザーの情報がデータベースになければ 
				$sql = "insert into students 
				(tw_user_id,tw_screen_name,tw_profile_image_url,tw_access_token,tw_access_token_secret) 
				values
				(:tw_user_id,:tw_screen_name,:tw_profile_image_url,:tw_access_token,:tw_access_token_secret)";
				$stmt = $dbh->prepare($sql);
				$params = array(
					":tw_user_id" => $me->id_str,
					":tw_screen_name" => $me->screen_name,
					":tw_profile_image_url" => $me->profile_image_url,
					":tw_access_token" => $reply->oauth_token,
					":tw_access_token_secret" => $reply->oauth_token_secret
				);
				$stmt->execute($params);

				$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
				$stmt = $dbh->prepare($sql);
				$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
				$user = $stmt->fetch();
			}
    
			//ログイン処理をする。ユーザー情報をセッションに格納する。
			if(!empty($user) && !isset($_SESSION['tw_user'])){
				session_regenerate_id(true); //セキュリティのためのおまじない
				$_SESSION['tw_user'] = $user; //ユーザー情報をセッションに格納
			}
    
    
			// send to same URL, without oauth GET parameters
			//$this->redirect(array('action' => 'student_edit'));
			//die();
		}
		$this->redirect(array('action' => 'student_edit'));
	}
	
	public function student_tw_logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
			if (isset($_COOKIE["PHPSESSID"])) {
				setcookie("PHPSESSID", '', time() - 1800, '/');
			}
		$this->redirect(array('action' => 'student_resister'));
	}
	
	public function student_resister() {
	
    $this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	// post時の処理
	if ($this->request->is('post')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
            $this->Student->create();
            if ($this->Student->save($this->request->data)) {	//ここにfalseと入れればバリデーションを無視できる
                $this->Session->setFlash(__('登録完了しました。管理者ログインページからサークル情報を編集してください。'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度やり直してください。'));
				//debug($this->Circle->validationErrors);
            }
			
    }
   
	}
	
	public function student_edit($id){
	
	$this->set('id', $id);
	
	$this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	
    if ($this->request->is('post') || $this->request->is('put')) {
			//ここでサニタイズする
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
            if ($this->Student->save($this->request->data, array('validate' => false))) {
				// $this->redirect(array('action'=>'follow')); //twitter
                $this->Session->setFlash(__('更新完了しました。'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            
    }
    else
    {
        $this->request->data=$this->Student->read(null,$id);//更新画面の表示
		
		
    }
	}
	
	//生徒のログイン
	//生徒のログインを別のコントローラーで扱う必要あり
	public function student_login() {
	$this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	if ($this->request->is('post')) {
                      $this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('アカウント名かパスワードが間違っています。'));
			}
		}
	}
 
	//ログアウト_login
	public function student_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'student_login'));
	}
	
	//ログアウト_home
	public function student_logout_home() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'home'));
	}
  
  
	
}
	

?>
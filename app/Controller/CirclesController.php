<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class CirclesController extends AppController {
	var $uses = array('Circle');

	
	public $components = array(
        'Session',
        'Auth' => array(
			'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Circle',
                    'fields' => array('username' => 'circle_name','password' => 'password')
					//2つで認証する場合、usernameとpasswordに対応するものが何かを明示する必要がある
                )
            
			),
            // ログイン後にジャンプ
            'loginRedirect' => array('controller' => 'Circles', 'action' => 'circle_edit'),
			//array('action'=>'edit',$data['User']['id'])
            // ログアウト後に /circles/circle_login へジャンプ
            'logoutRedirect' => array('controller' => 'Circles', 'action' => 'circle_login'))
        );
 
    public function beforeFilter() {
        // 各コントローラーの index と login を有効にする
        $this->Auth->allow('circle','home','student','link','circle_login','about','recruit');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.circles';
    }
	
	
	
	public function circle_edit(){
	$id = $this->Auth->user('id');
	$this->set('tmp', $id);
	
	$this->modelClass = null;
    $this->layout = "layout_circle_edit";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
    $this->Circle->id=$id;
	
    if ($this->request->is('post') || $this->request->is('put')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
            if ($this->Circle->save($this->request->data, array('validate' => false))) {
				// $this->redirect(array('action'=>'follow')); //twitter
                $this->Session->setFlash(__('更新完了しました。'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            


    }
    else
    {
        $this->request->data=$this->Circle->read(null,$id);//更新画面の表示
		
		
    }
	}
	
	//サークルのログイン
	public function circle_login() {
	$this->modelClass = null;
    $this->layout = "layout_circle";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	if ($this->request->is('post')) {
                      $this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('サークル名かパスワードが間違っています。'));
			}
		}
	}
 
	//ログアウト_login
	public function circle_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'circle_login'));
	}
	
	//ログアウト_home
	public function circle_logout_home() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'home'));
	}
	
	
	
  
  
	
}
	

?>
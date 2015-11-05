<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class StudentsController extends AppController {
	var $uses = array('Student');

	public $components = array(
        'Session',
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
        $this->Auth->allow('circle','home','student','link','studnet_login','about','recruit','student_login','student_resister');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.students';
    }
	
	public function student_resister() {
	
    $this->modelClass = null;
    $this->layout = "layout_student";
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
	
	public function student_edit(){
	$id = $this->Auth->user('id');
	$this->set('tmp', $id);
	
	$this->modelClass = null;
    $this->layout = "layout_student_edit";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
    $this->Student->id=$id;
	
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
    $this->layout = "layout_student";
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
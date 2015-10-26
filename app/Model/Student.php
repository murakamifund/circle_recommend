<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Student extends AppModel {
	 /**
 * 保存時にパスワードをハッシュ化する
 */
   public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
    }
    return true;
}
public $validate = array(
        'student_name' => array(
          'rule'=>array('isUnique'),
		  'required'=>true,
		  'message'=>'すでに同じ名前が登録されています。',
		  'on'=>'create'
        ),
        'password' => array(
            'rule'=>'alphaNumeric',
			'required'=>true,
			'message'=>'パスワードを正しく入力してください。'
        ),
		
		
        
    );
     
}
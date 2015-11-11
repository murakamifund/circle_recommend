<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Circle extends AppModel {
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
        'circle_name' => array(
          'rule'=>array('isUnique'),
		  'required'=>true,
		  'message'=>'すでに同じ名前のサークルが登録されています。',
		  'on'=>'create'
        ),
        'password' => array(
            'rule'=>'alphaNumeric',
			'required'=>true,
			'message'=>'パスワードを正しく入力してください。'
        ),
		'twitterid' => array(
            'rule'=>'alphaNumeric',
			'required'=>true,
			'message'=>'TwitterIDを入力してください。'
        ),
		'placetext' => array(
            'rule'=>array('maxLength', 15),
			'required'=>true,
			'message'=>'15文字までです。'
        ),
		'pr' => array(
            'rule'=>array('maxLength', 100),
			'required'=>true,
			'message'=>'100文字以内でPR文を入力してください。'
        ),
		'activity' => array(
			'required'=>true,
			'message'=>'選択してください。'
        ),
		'nomi' => array(
			'required'=>true,
			'message'=>'選択してください。'
        ),
		'mazime' => array(
			'required'=>true,
			'message'=>'選択してください。'
        ),
        
    );
     
}
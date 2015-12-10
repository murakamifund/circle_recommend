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
		
        
    );
    
    /*public $actsAs = [
        'Upload.Upload' => [
            'photo' => [
                'fields' => [
                    'dir' => 'photo_dir'
                ],
            "path" => "{ROOT}webroot{DS}files{DS}{model}{DS}{field}{DS}",
            "rootDir" => ROOT . DS . APP_DIR . DS,
            "pathMethod" => "primaryKey"
            ]
        ]
    ];*/

     
}
?>
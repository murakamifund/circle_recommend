<?php
//config.php
//いろいろな設定を書くファイル

define('DSN','mysql:host=127.0.0.1;dbname=circlerecommend;charset=utf8');
define('DB_USER','root');
define('DB_PASSWORD','');
//define('DSN','mysql:host=mysql496.db.sakura.ne.jp,dbname=blackjack-utokyo_ut_circle,charset=utf8');
//define('DB_USER','blackjack-utokyo');
//define('DB_PASSWORD','NR8tpuTcadCJ7p');

define('CONSUMER_KEY','hyj7wJ2xfSkADK6bhJfUFbhAd');
define('CONSUMER_SECRET','w145AA0P8opGRji1OzdLlyxA2W6fdqwEONlryr6A0kfucE8NwS');

define('SITE_URL','http://127.0.0.1/circle_recommend/'); //ローカル環境のurlを定義しておく

error_reporting(E_ALL & ~E_NOTICE);



?>
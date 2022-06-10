<?php
session_start();


$user_id =$_GET['id'];
$password = $_GET['password'];

$db = new PDO('mysql:host=localhost; dbname=demo', 'root', '');

try{
    $db->beginTransaction();

    $sql = 'INSERT INTO login ( user_id , password ) VALUES("'. $user_id .'","'. $password .'");';

    // データベースに事前にSQLを登録する
    $stm = $db->prepare( $sql );

    // SQLを実行する
    $stm->execute();
    
    $db->commit(); 

    echo '成功';

}catch ( Exception $e ) {
    // データベースエラーなので、ロールバックする
    $db->rollback();
    // XXX エラーメッセージを表示する
    echo "データベースエラー" . $e->getMessage();
}

$html = file_get_contents('user_regist.html');

print($html);


?>

<?php
session_start();


ini_set('display_errors', 0);
if($_POST['key'] != ''){
    $key = $_POST['key'];
    // var_dump($key);
}else{
    $key ='';
}
unset($_POST);

if($key === ''){
    $like = '';
}else{
    $like = ' WHERE ds.comment' . ' LIKE "%'. $key .'%"';
}

$db = new PDO('mysql:host=localhost; dbname=demo', 'root', '');

try{
    $db->beginTransaction();

    $sql = 'SELECT ds.id , l.user_id , ds.comment 
            FROM displayusers as ds LEFT OUTER JOIN login as l
            ON ds.id = l.id'.$like.';';
    
    $stm = $db->prepare( $sql );
    
    // SQLを実行する
    $stm->execute();

    // 結果を取得する
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $db->commit(); 

}catch ( Exception $e ) {
    // XXX エラーメッセージを表示する
    $error_message = 'データベースエラー';
    echo $error_message . $e->getMessage();
}


$html = file_get_contents('user_regist.html');

$html_top = explode( '###loop###', $html );

$html_bottom = explode( '###/loop###', $html_top[1] );

$html_middle = '';

foreach( $result as $line ){
    $html_line = $html_bottom[0];

    $html_line = str_replace( '$$$id$$$', htmlspecialchars( $line['id'] ), $html_line );
    $html_line = str_replace( '$$$user_id$$$', htmlspecialchars( $line['user_id'] ), $html_line );
    $html_line = str_replace( '$$$comment$$$', htmlspecialchars( $line['comment'] ), $html_line );

    $html_middle= $html_middle . $html_line;
}

// 作った真ん中の部分と、前後を貼り合わせる
$html = $html_top[0] . $html_middle . $html_bottom[1];

print($html);


?>

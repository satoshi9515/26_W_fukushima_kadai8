<?php
//1.GETでidを取得
$c_id=$_GET["c_id"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'DELETE FROM gs_course_table WHERE c_id=:c_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_id', $c_id, PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: univ_mainmenu.php");
  exit;

}



?>

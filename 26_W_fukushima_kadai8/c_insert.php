<?php

//1. POSTデータ取得
$tt_name=$_POST["tt_name"];
$c_name=$_POST["c_name"];
$c_length=$_POST["c_length"];
$s_id = implode(',', $_POST["s_id"]);
$cnt_s_id = count($_POST["s_id"]);
$t_id = $_POST["t_id"];



//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO  gs_course_table (c_id, c_name, tt_name, c_length, s_id, t_id,
cnt_s_id) VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6)");
$stmt->bindValue(':a1', $c_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $tt_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $c_length, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $s_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $t_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $cnt_s_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: c_select.php");
  exit;

}
?>

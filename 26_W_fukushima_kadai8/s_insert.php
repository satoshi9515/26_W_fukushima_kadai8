<?php
//入力チェック(受信確認処理追加)

//1. POSTデータ取得
$s_name=$_POST["s_name"];
$s_account=$_POST["s_account"];
$s_pw=$_POST["s_pw"];
$s_mail=$_POST["s_mail"];




//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO  gs_students_table (s_id, s_name, s_account, s_mail, s_pw,
indate )VALUES(NULL, :a1, :a2, :a3,:a4, sysdate())");
$stmt->bindValue(':a1', $s_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $s_account, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $s_mail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $s_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: s_select.php");
  exit;

}
?>

<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["t_name"]) || $_POST["t_name"]=="" ||
  !isset($_POST["t_account"]) || $_POST["t_account"]=="" ||
  !isset($_POST["t_mail"]) || $_POST["t_mail"]=="" ||
  !isset($_POST["t_pw"]) || $_POST["t_pw"]==""
){
  exit('ParamError');
}


//1. POSTデータ取得
$t_name=$_POST["t_name"];
$t_account=$_POST["t_account"];
$t_pw=$_POST["t_pw"];
$t_mail=$_POST["t_mail"];




//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO  gs_teachers_table (t_id, t_name, t_account, t_mail, t_pw,
indate )VALUES(NULL, :a1, :a2, :a3,:a4, sysdate())");
$stmt->bindValue(':a1', $t_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $t_account, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $t_mail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $t_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: t_select.php");
  exit;

}
?>

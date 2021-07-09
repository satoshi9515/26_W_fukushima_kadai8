<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["u_name"]) || $_POST["u_name"]=="" ||
  !isset($_POST["u_account"]) || $_POST["u_account"]=="" ||
  !isset($_POST["u_pw"]) || $_POST["u_pw"]==""
){
  exit('ParamError');
}


//1. POSTデータ取得
$u_name=$_POST["u_name"];
$u_account=$_POST["u_account"];
$u_pw=$_POST["u_pw"];
$u_life_flg=$_POST["u_life_flg"];




//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO  gs_univ_table (u_id, u_name, u_account, u_pw, u_life_flg,
indate )VALUES(NULL, :a1, :a2, :a3,:a4, sysdate())");
$stmt->bindValue(':a1', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $u_account, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $u_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $u_life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: login.php");
  exit;

}
?>

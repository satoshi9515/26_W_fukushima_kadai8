<?php
//入力チェック(受信確認処理追加)

//1. POSTデータ取得
$s_name=$_POST["s_name"];
$s_account=$_POST["s_account"];
$s_pw=$_POST["s_pw"];
$s_life_flg=$_POST["s_life_flg"];
$s_mail=$_POST["s_mail"];
$s_id=$_POST["s_id"];




//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_students_table SET s_name=:s_name, s_account=:s_account, s_mail=:s_mail, s_pw=:s_pw, s_life_flg=:s_life_flg  WHERE s_id=:s_id");
$stmt->bindValue(':s_id' ,$s_id,  PDO::PARAM_INT); 
$stmt->bindValue(':s_name', $s_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':s_account', $s_account, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':s_mail', $s_mail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':s_pw', $s_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':s_life_flg', $s_life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

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

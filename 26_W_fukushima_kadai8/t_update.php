<?php
//入力チェック(受信確認処理追加)

//1. POSTデータ取得
$t_name=$_POST["t_name"];
$t_account=$_POST["t_account"];
$t_pw=$_POST["t_pw"];
$t_life_flg=$_POST["t_life_flg"];
$t_mail=$_POST["t_mail"];
$t_id=$_POST["t_id"];




//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_teachers_table SET t_name=:t_name, t_account=:t_account, t_mail=:t_mail, t_pw=:t_pw, t_life_flg=:t_life_flg  WHERE t_id=:t_id");
$stmt->bindValue(':t_id' ,$t_id,  PDO::PARAM_INT); 
$stmt->bindValue(':t_name', $t_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':t_account', $t_account, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':t_mail', $t_mail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':t_pw', $t_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':t_life_flg', $t_life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

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

<?php
session_start();
$u_account = $_POST["lid"];
$u_pw = $_POST["lpw"];


//1. 接続します
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_univ_table WHERE u_account=:u_account AND u_pw=:u_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_account', $u_account);
$stmt->bindValue(':u_pw', $u_pw);
$res = $stmt->execute();

echo $res;

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["u_id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["u_name"]   = $val['u_name'];
  $_SESSION["u_account"]  = $_POST["lid"];
  $_SESSION["u_pw"]  = $_POST["lpw"];
  //Login処理OKの場合select.phpへ遷移
  header("Location: univ_mainmenu.php");
}else{
  $samural_alert = "IDまたはパスワードが違います";
// ②
  $alert = "<script type='text/javascript'>alert('". $samural_alert. "');</script>";
  // ③
  echo $alert;
  echo "<script language=javascript>location.href ='login.php'</script>";

  
}

//処理終了
exit();

?>



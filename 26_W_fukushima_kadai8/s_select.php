<?php
session_start();
include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_students_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= '<a href="s_view.php?s_id='.$result["s_id"].'">';
    $view .= '学生名　';
    $view .= $result["s_name"]."　:アカウント名".$result["s_account"];
    $view .='</a>';
    $view .='　　';
    $view .= '<a href="s_delete.php?s_id='.$result["s_id"].'">';
    $view .='[削除]';

    $view .='</a>';
    
    $view .="</p>";
  }

}


$num_class="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $num_class .= '<p>';
    $num_class .= ' 学生名 ';
    $num_class .= $result["tt_name"];
    $num_class .= ' 担当授業数 ';
    $num_class .= $result["num_class"];
    $num_class .= ' コマ ';
    $num_class .= '</p>';  
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>学生管理</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="univ_mainmenu.php">メインメニュー</a>
        <a class="navbar-brand" href="s_regist.php">学生登録</a>
        <a class="navbar-brand" href="s_select.php">学生管理</a>
        <a class="navbar-brand" href="c_regist.php">学生授業登録</a>
        <a class="navbar-brand" href="c_select.php">学生授業管理</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>

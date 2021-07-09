<?php
session_start();
include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_course_table");
$status = $stmt->execute();

//３．データ表示
$view="";
$stu_ids="";

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= '<a href="c_view.php?c_id='.$result["c_id"].'">';
    $view .= ' 授業名 ';
    $view .= $result["c_name"];
    $view .= ' 講師名 ';
    $view .= $result["tt_name"]." :授業時間".$result["c_length"];
    $view .='分'; 
    
    $view .= ' 登録学生ID '.$result["s_id"];
    $view .= ' 登録学生数 '.$result["cnt_s_id"].'名';
    $view .='</a>';
    $view .= '<a href="delete.php?c_id='.$result["c_id"].'">';
    $view .=' [削除] ';

    $view .='</a>';
    
    $view .="</p>";
  };
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>授業・講師管理</title>
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
        <a class="navbar-brand" href="t_regist.php">講師登録</a>
        <a class="navbar-brand" href="t_select.php">講師管理</a>
        <a class="navbar-brand" href="c_regist.php">授業登録</a>
        <a class="navbar-brand" href="c_select.php">授業管理</a>
      
      
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

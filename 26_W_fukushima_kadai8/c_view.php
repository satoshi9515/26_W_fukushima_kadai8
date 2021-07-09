<?php
//1.GETでid値を取得
$c_id = $_GET["c_id"];


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_course_table left outer join gs_teachers_table ON gs_course_table.tt_name=gs_teachers_table.t_name WHERE c_id=:c_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_id', $c_id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}
session_start();
include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT t_name FROM gs_teachers_table");
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
    // $view .= '<select>';
    $view .= '<option>';
    $view .= $result["t_name"];
    $view .= "</option>";
 
  }

}


$stmt = $pdo->prepare("SELECT * FROM gs_students_table");
$status = $stmt->execute();

//３．データ表示
$sview="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $sresult = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= '<select>';
    $sview .= '<input type="checkbox"'; 
    $sview .= 'name="s_id[]" value=';
    $sview .= $sresult["s_id"];
    $sview .= ' multiple>';
    $sview .= $sresult["s_name"];
  
 
  }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>授業情報更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

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
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="c_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>授業情報更新</legend>
    <label><input name="c_id" type="hidden" value="<?=$row["c_id"]?>"></label><br>
     <label>授業名：<input type="text" name="c_name" value="<?=$row["c_name"]?>"></label><br>
     <label>講師名：<select name="tt_name"  value="<?=$view?>"><?=$view?></select></label><br>
     <label>授業時間：<input type="text" name="c_length" value="<?=$row["c_length"]?>">分</label><br>
     <label>学生選択：<?=$sview?></label><br>
     <label><input name="t_id" type="hidden" value="<?=$row["gs_teachers_table.t_id"]?>"></label><br>
     
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

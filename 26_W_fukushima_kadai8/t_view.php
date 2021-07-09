<?php
//1.GETでid値を取得
$t_id = $_GET["t_id"];


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_teachers_table WHERE t_id=:t_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>講師情報更新</title>
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
<form method="post" action="t_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規講師登録</legend>
    <label><input name="t_id" type="hidden" value="<?=$row["t_id"]?>"></label><br>
     <label>名前：<input type="text" name="t_name" value="<?=$row["t_name"]?>"></label><br>
     <label>アカウント名：<input type="text" name="t_account" value="<?=$row["t_account"]?>"></label><br>
     <label>メールアドレス：<input type="text" name="t_mail" value="<?=$row["t_mail"]?>"></label><br>
     <label>パスワード：<input type="text" name="t_pw" value="<?=$row["t_pw"]?>"></label><br>
     <label><input type="hidden" name="t_life_flg" value="0"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規学生登録</title>
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
        <a class="navbar-brand" href="t_select.php">授業管理</a>
        <a class="navbar-brand" href="c_regist.php">授業登録</a>
        <a class="navbar-brand" href="c_select.php">授業管理</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="s_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規学生登録</legend>
    <label><input name="s_id" type="hidden"></label><br>
     <label>名前：<input type="text" name="s_name"></label><br>
     <label>アカウント名：<input type="text" name="s_account"></label><br>
     <label>メールアドレス：<input type="text" name="s_mail"></label><br>
     <label>パスワード：<input type="text" name="s_pw"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

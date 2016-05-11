<!DOCTYPE html>
<?php
// session_start();
// //パソコンとサーバ間で毎回session_idを変える。セキュリティー上必要ば処理
// session_regenerate_id(true);
// if(isset($_SESSION['login']) == false)
// {
//   print 'ログインされていません<br />';
//   print '<a href="staff_login.html">ログイン画面へ</a>';
//   exit();
// }
// else {
//   print $_SESSION['staff_name'];
//   print 'さんがログイン中<br />';
//   print '<br />';
// }
 ?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>php練習</title>
</head>
<body>
  <?php
    try
    {
      $staff_code = $_GET['staffcode'];
      $dsn = 'mysql:dbname=shop;host=localhost';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password,
        //MYSQLの文字化け対策
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"
        )
      );
      $sql = 'SELECT name FROM mst_staff WHERE code = ?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $staff_code;
      $stmt -> execute($data);
      $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
      $staff_name = $rec['name'];
      $dbh = null;
    }
    catch (Exception $e)
    {
      print 'ただいまエラーが発生しております';
      exit();
    }
  ?>
  <h3>スタッフ修正</h3>
  <p>スタッフ番号<?php print $staff_code; ?></p>
	<!--valueに値をセットするとそれが初期値になる-->
  <form method="post" action="staff_edit_check.php" value="<?php print $staff_code; ?>">
  スタッフ名<br />
  <input type="text" name="name"style="width:200px"value="<?php print $staff_name ?>"><br />
  パスワードを入力してください<br />
  <input type="password" name="password" style="width:100px"><br />
  パスワードをもう一度入力してください<br />
  <input type="password" name="repassword" style="width:100px"><br />
  <br />
  <input type="button"onclick="history.back()"value="戻る">
  <input type="submit"value="OK">
  </form>
</body>
</html>

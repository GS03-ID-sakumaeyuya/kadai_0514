<!DOCTYPE html>
<?php
// session_start();
// //パソコンとサーバ間で毎回session_idを変える。セキュリティー上必要ば処理
// session_regenerate_id(true);
// if(isset($_SESSION['login']) == false)
// {
//   echo 'ログインされていません<br />';
//   echo '<a href="staff_login.html">ログイン画面へ</a>';
//   exit();
// }
// else {
//   echo $_SESSION['staff_name'];
//   echo 'さんがログイン中<br />';
//   echo '<br />';
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
      $staff_code = $_POST['code'];
      $staff_name = $_POST['name'];
      $staff_password = $_POST['password'];

      $staff_name = htmlspecialchars($staff_name);
      $staff_password = htmlspecialchars($staff_password);

      //28行目までがdb接続プログラム
      $dsn = 'mysql:dbname=shop;host=localhost';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password,
        //MYSQLの文字化け対策
        array(
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"
        )
      );

      $dbh->query('SET NAMES utf-8');
      //入れたいデータは「?」で表す
      $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $staff_name;
      $data[] = $staff_password;
      $data[] = $staff_code;
      $stmt -> execute($data);
      //dbを切断する
      $dbh = null;
    }
    catch(Exception $e)
    {
      echo 'ただいま障害が発生しています';
      exit();
    }
  ?>
  修正しました<br />
  <a href="staff_list.php">戻る</a>
</body>
</html>

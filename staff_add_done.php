<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>php</title>
</head>
<body>
  <?php
    try
    {
      $staff_name = $_POST['name'];
      $staff_password = $_POST['password'];

      $staff_name = htmlspecialchars($staff_name);
      $staff_password = htmlspecialchars($staff_password);

      //28行目までがdb接続プログラム
      $dsn = 'mysql:dbname=shop;host=localhost';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);

      $dbh->query('SET NAMES utf-8');
      //入れたいデータは「?」で表す
      $sql = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
      $stmt = $dbh -> prepare($sql);
      $data[] = $staff_name;
      $data[] = $staff_password;
      $stmt -> execute($data);
      //dbを切断する
      $dbh = null;
      print $staff_name.'さんを追加しました<br />';
    }
    catch(Exception $e)
    {
      print 'ただいま障害が発生しています';
      exit();
    }
  ?>
  <a href="staff_list.php">戻る</a>
</body>
</html>

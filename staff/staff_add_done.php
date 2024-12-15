<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
        <?php
        //データベースサーバーの障害対策　エラートラップ
        try
        {
            $staff_name=$_POST['name'];
            $staff_pass=$_POST['pass'];

            //入力情報に対する安全対策
            $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
            $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

            //データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //SQL文を用いてデータベースにコードを追加する
            $sql='INSERT INTO mst_staff(name,password) VALUES (?,?)';
            $stmt=$dbh->prepare($sql);
            $data[]=$staff_name;
            $data[]=$staff_pass;
            //データベースに命令を出す
            $stmt->execute($data);

            //データベースから切断する
            $dbh=null;

            print $staff_name;
            print 'さんを追加しました。<br>';
        }
        catch(Exception $e)
        {
            //データベースサーバに障害が発生したら動く
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            //強制終了
            exit();
        }
        ?>
        <a href="staff_list.php">戻る</a>
    </body>
</html>
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
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            $pro_gazou_name=$_POST['gazou_name'];

            //入力情報に対する安全対策
            $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
            $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

            //データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // general_log を有効にする
            $dbh->exec("SET GLOBAL general_log = 'ON';");

            //SQL文を用いてデータベースにコードを追加する
            $sql='INSERT INTO mst_product(name,price,gazou) VALUES (?,?,?)';
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_name;
            $data[]=$pro_price;
            $data[]=$pro_gazou_name;
            //データベースに命令を出す
            $stmt->execute($data);
            
            //データベースから切断する
            $dbh=null;

            print $pro_name;
            print 'を追加しました。<br>';
        }
        catch(Exception $e)
        {
            //データベースサーバに障害が発生したら動く
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            //強制終了
            exit();
        }
        ?>
        <a href="pro_list.php">戻る</a>
    </body>
</html>
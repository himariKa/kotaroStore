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
            $pro_code=$_POST['code'];
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            var_dump($pro_code);
            var_dump($pro_name);
            var_dump($pro_price);

            //入力情報に対する安全対策
            $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
            $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
            $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

            //データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //SQL文を用いてデータベースにコードを追加する
            $sql='UPDATE mst_product SET name=?,price=? WHERE code=?';
            $stmt=$dbh->prepare($sql);
            
            //SQL文に入れる順にデータを入れる 
            $data[]=$pro_name;
            $data[]=$pro_price;
            $data[]=$pro_code;
            
            // var_dump($data);
            //データベースに命令を出す
            $stmt->execute($data);
            
            //データベースから切断する
            $dbh=null;
        }
        catch(Exception $e)
        {
            //データベースサーバに障害が発生したら動く
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            //強制終了
            exit();
        }
        ?>
        修正しました。<br>
        <br>
        <a href="pro_list.php">戻る</a>
    </body>
</html>
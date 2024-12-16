<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
        <?php
        try
        {
            // データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //商品のコードと名前を全て取得
            $sql='SELECT code,name,price FROM mst_product WHERE 1';
            $stmt=$dbh->prepare($sql);
            $stmt->execute();

            //データベースから切断する
            $dbh=null;

            print'商品一覧<br><br>';
            //商品情報　修正と削除の分岐
            print'<form method="post" action="pro_branch.php">';

            while(true)
            {
                $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec==false)
                    {
                        break;
                    }
            //ラジオボタンの表示(valueの値は遷移先[staff_edit]で使うことができる)
            print'<input type="radio" name="procode" value="'.$rec['code'].'">';
            print $rec['name'].'---';
            print $rec['price'].'円';
            print'<br>';
            }
            print'<input type ="submit" name="disp" value="参照">';
            print'<input type ="submit" name="add" value="追加">';
            print'<input type ="submit" name="edit" value="修正">';
            print'<input type ="submit" name="delete" value="削除">';
            print'</form>';
        }
        catch(Exception $e)
        {
            //データベースサーバに障害が発生したら動く
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            //強制終了
            exit();
        }
        ?>
    </body>
</html>
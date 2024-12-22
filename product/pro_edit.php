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
            $pro_code=$_POST['procode'];
            $pro_code=$_GET['procode'];

            //入力情報に対する安全対策
            $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');

            //データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //SQL文を用いてデータベースにコードから一件データを取得する
            $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_code;

            //データベースに命令を出す
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);

            //pro_nameを後続の処理で使えるように代入しておく
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou_name_old =$rec['gazou'];

            //データベースから切断する
            $dbh=null;

            if($pro_gazou_name_old==''){
                $disp_gazou='';
            }
            else
            {
                $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
            }
        }
        catch(Exception $e)
        {
            //データベースサーバに障害が発生したら動く
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            //強制終了
            exit();
        }
        ?>
        商品修正<br>
        <br>
        商品コード<br>
        <?php print $pro_code;?>
        <br>
        <br>
        <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php print $pro_code;?>">
            <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old;?>">
            商品名<br>
            <!-- 名前を入力済みにセット -->
            <input type="text" name="name" style="width:200px" value="<?php print $pro_name;?>"><br>
            価格<br>
            <input type="text" name="price" style="width:50px" value="<?php print $pro_price;?>">円<br>
            <br>
            画像を選んでください。<br>
            <input type="file" name="gazou" style="width:400px"><br>
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </body>
</html>
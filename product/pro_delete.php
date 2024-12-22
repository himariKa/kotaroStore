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
            $sql='SELECT name,gazou FROM mst_product WHERE code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_code;
            //データベースに命令を出す
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);

            //pro_nameを後続の処理で使えるように代入しておく
            $pro_name = $rec['name'];
            $pro_gazou_name = $rec['gazou'];

            //データベースから切断する
            $dbh=null;

            if($pro_gazou_name==''){
                $disp_gazou='';
            }else{
                $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
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
        商品削除<br>
        <br>
        商品コード<br>
        <?php print $pro_code;?>
        <br>
        商品名<br>
        <?php print $pro_name;?>
        <br>
        <?php print $disp_gazou;?>
        <br>
        この商品を削除してよろしいですか？<br>
        <br>
        <form method="post" action="pro_delete_done.php">
            <input type="hidden" name="code" value="<?php print $pro_code;?>">
            <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name;?>">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </body>
</html>
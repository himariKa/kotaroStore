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
            $staff_code=$_POST['staffcode'];
            $staff_code=$_GET['staffcode'];

            //入力情報に対する安全対策
            $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');

            //データベースに接続する
            $dsn='mysql:dbname=shop2;host=localhost;charset=utf8';
            $user='root';
            $password='';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //SQL文を用いてデータベースにコードから一件データを取得する
            $sql='SELECT name FROM mst_staff WHERE code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$staff_code;
            //データベースに命令を出す
            $stmt->execute($data);
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);

            //staff_nameを後続の処理で使えるように代入しておく
            $staff_name = $rec['name'];

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
        スタッフ情報参照<br>
        <br>
        スタッフコード<br>
        <?php print $staff_code;?>
        <br>
        スタッフ名<br>
        <?php print $staff_name;?>
        <br>
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        </form>
    </body>
</html>
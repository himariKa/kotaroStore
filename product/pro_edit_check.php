<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
        <?php 

        $pro_code=$_POST['code'];
        $pro_name=$_POST['name'];
        $pro_price=$_POST['price'];

        $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
        $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
        $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

        //　商品名が入力されているかチェック
        if($pro_name=='')
        {
            print'商品名が入力されていません。<br>';
        }
        else
        {
            print'商品名：';
            print $pro_name;
            print'<br>';
        }

        // 一つ目のパスワードが入力されているかチェック
        if($pro_price=='')
        {
            print'価格が入力されていません。<br>';
        }

        // 戻るボタン
        if($pro_name==''||$pro_pass=='')
        {
            print'<form>';
            print'<input type="button" onclick="history.back()" value="戻る">';
            print'</form>';
        }
        else
        {
            print'<form method="post" action="pro_edit_done.php">';
            print'<input type="hidden" name="code" value="'.$pro_code.'">';
            print'<input type="hidden" name="name" value="'.$pro_name.'">';
            print'<br>';
            print'<input type="button" onclick="history.back()" value="戻る">';
            print'<input type="submit" value="OK">';
            print'</form>';

        }
        ?>
    </body>
</html>
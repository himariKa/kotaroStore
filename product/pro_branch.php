<?php
//スタッフの参照
if(isset($_POST['disp'])==true)
{
    //もしprocodeがなかったらpro_ngに飛ぶ
    if(isset($_POST['procode'])==false)
    {
        header('Location:pro_ng.php');
        exit();
    }

    $pro_code=$_POST['procode'];
    header('Location:pro_disp.php?procode='.$pro_code);
    exit();
}

//スタッフの追加
if(isset($_POST['add'])==true)
{
    header('Location:pro_add.php');
    exit();
}

//スタッフの編集
if(isset($_POST['edit'])==true)
{
    //もしprocodeがなかったらpro_ngに飛ぶ
    if(isset($_POST['procode'])==false)
    {
        header('Location:pro_ng.php');
        exit();
    }

    $pro_code=$_POST['procode'];
    header('Location:pro_edit.php?procode='.$pro_code);
    exit();
}

//スタッフの削除
if(isset($_POST['delete'])==true)
{
    //もしprocodeがなかったらpro_ngに飛ぶ
    if(isset($_POST['procode'])==false)
    {
        header('Location:pro_ng.php');
        exit();
    }
    $pro_code=$_POST['procode'];
    header('Location:pro_delete.php?procode='.$pro_code);
    exit();
}
?>
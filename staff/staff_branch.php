<?php
//スタッフの参照
if(isset($_POST['disp'])==true)
{
    //もしstaffcodeがなかったらstaff_ngに飛ぶ
    if(isset($_POST['staffcode'])==false)
    {
        header('Location:staff_ng.php');
        exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staff_code);
    exit();
}

//スタッフの追加
if(isset($_POST['add'])==true)
{
    header('Location:staff_add.php');
    exit();
}

//スタッフの編集
if(isset($_POST['edit'])==true)
{
    //もしstaffcodeがなかったらstaff_ngに飛ぶ
    if(isset($_POST['staffcode'])==false)
    {
        header('Location:staff_ng.php');
        exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_edit.php?staffcode='.$staff_code);
    exit();
}

//スタッフの削除
if(isset($_POST['delete'])==true)
{
    //もしstaffcodeがなかったらstaff_ngに飛ぶ
    if(isset($_POST['staffcode'])==false)
    {
        header('Location:staff_ng.php');
        exit();
    }
    $staff_code=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();
}
?>
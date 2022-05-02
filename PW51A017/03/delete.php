<?php 
//削除画面のコントローラー

session_start();

//定数呼び出し
require_once '../../const.php';
//関数呼び出し
require_once './func.php';

//初期化
$err = [];
$id = '';

//一覧画面で指定された単行本の情報
if (isset($_GET['id'])) {
    //一覧画面で[変更]リンクをクリックされた単行本情報（id）を受け取る
    $id = $_GET['id'];

    //[削除]リンクを押された単行本の変更前情報を表示（登録画面からこの変更画面に飛んできた時。）
    //SQL文作ります
    $sql = "SELECT * FROM m_book WHERE id = " . $id . ";";

    //DB連結したい
    $link = mysqli_connect( HOST , USER_ID , PASSWORD , DB_NAME);
    mysqli_set_charset($link , 'utf8');

    $result = mysqli_query($link ,$sql);
    $row = mysqli_fetch_assoc($result);
    //発売日の表記を"年月日"にする
    $row['release_date'] = explode("-",$row['release_date']);

    //購入日が入ってる（NULLじゃない場合）
    if ($row['purchase_date'] !== NULL) {
        $row['purchase_date'] = explode("-",$row['purchase_date']); //購入日の表記を"年月日"にする
    }
    //画像があるかどうか？
    if (file_exists(DIR_IMG . $row['id'] . '.jpg')) {
        $row['img_path'] = DIR_IMG . $row['id'] . '.jpg';
    }
    else{
        $row['img_path'] = './img/no_image.png';
    }
    mysqli_close($link);
}

//[単行本の情報を変更する]ボタンを押された時（問答無用で論理削除）
if(isset($_POST['state']) && $_POST['state'] == 'delete'){
    //一覧画面で[変更]リンクをクリックされた単行本情報（id）を受け取る
    $id = $_POST['id'];

    //今日の日付を取得(YYYYmmdd)
    $today = date("Ymd");

    //SQL文作成
    $sql = "UPDATE m_book SET del_date = " . $today . " WHERE id = " . $id . ";";
    //DB接続
    $link = mysqli_connect( HOST , USER_ID , PASSWORD , DB_NAME);
    mysqli_set_charset($link , 'utf8');
    
    mysqli_query($link ,$sql);

    //登録完了メッセージを入れる
    $_SESSION['msg'] = '削除が完了しました！';

    //登録完了画面に遷移
    header('location:./list.php');
    exit;
}

//ビューの表示
require_once 'tpl/delete.php';
?>
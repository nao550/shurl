<?php
ini_set( 'display_error', 1 );  // Show error message.

require( './config.php' );
require_once( './libs/Smarty.class.php' );
$smarty = new Smarty();

/*
ゲットで変数が来ているかどうかチェック
 変数がなければ標準画面
 変数があれば変数をチェック
   mode=gen で shurl 生成画面
   mode=error でエラー発生したので再入力画面
   mode=shurl で shurl を受け取ったと解釈
*/

if( isset( $_GET['mode'] )){
    if( $_GET['mode'] == 'gen' ){
        $mode = $_GET['mode'];           
    } elseif( $_GET['mode'] == 'error' ){
        $mode = $_GET['mode'];
    } elseif( $_GET['mode'] == 'shurl' ){
        $mode = $_GET['mode'];
    }
} else {
    $mode = "first";
}

if ( $mode == 'first' ){
    /*
      標準画面の表示
      生成ボタン で org_url、shchar、cutoff、をGETで送る
    */
    $smarty->display( 'header.tbl' );
    $smarty->assign( 'minchar', MINSHCHAR );
    $smarty->assign( 'org_url', '' );
    $smarty->assign( 'shchar', '' );
    $smarty->display( 'first.tbl' );


} elseif( $mode == 'gen' ){
    /*
      url生成画面
      shchar の有無チェック
      shchar あれば
      shchar の長さチェック
      エラーで mode=error で戻す
      shchar なければ、org_url,time より hash で shchar 生成

      org_url,shchar,day を dat へ登録

      shurl の画面を表示
    */

    $errorflag = 0;
    if( $_GET['org_url'] == "" ){
        $errorflag += 1;
    }
    if( $_GET['shchar'] == "" ){
        $errorflag += 1 ;
    }
    if( $errorflag != 0 ){
        header('Location: ./sh.php?mode=error&org_url=' .$_GET['org_url'] . '&shchar=' . $_GET['shchar']);
    }

    $org_url = $_GET['org_url'];
    $shchar = $_GET['shchar'];
    print( 'gen mode' );

} elseif ( $mode == 'shurl' ){
    /*
      shurl を受け取った
      GET で shchar を取り出し
      shchar で dat を検索
      dat になればエラー画面
      dat にあれば location  hogeで移動
    */

    $shchar = $_GET['shurl'];
    print( 'shurl mode.' );

} elseif( $mode == 'error' ){
    /*
      エラーチェック
    */
    $smarty->display( 'header.tbl' );
    if( $_GET['org_url'] == '' ){
        $smarty->assign( 'err_url', '<div class="error">URLを入力してください。</div>');
    }
    if( $_GET['shchar'] == '' ){
        $smarty->assign( 'err_shchar', '<div class="error">文字列が短すぎます。</div>');
    }
    $smarty->assign( 'minchar', MINSHCHAR );
    $smarty->assign( 'org_url', ' value="'. $_GET['org_url'] .'"' );
    $smarty->assign( 'shchar', ' value="'. $_GET['shchar'] . '"');
    $smarty->display( 'first.tbl' );
    
    print( 'error mode' );

}

$smarty->display( 'footer.tbl' );


?>



 

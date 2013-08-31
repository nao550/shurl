<?php
ini_set( 'display_error', 1 );  // Show error message.

require( './config.php' );
require( './datclass.inc' );
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
    if( $_GET['mode'] == 'first' ){
        $mode = $_GET['mode'];
    } elseif( $_GET['mode'] == 'gen' ){
        $mode = $_GET['mode'];
    } elseif( $_GET['mode'] == 'error' ){
        $mode = $_GET['mode'];
    } elseif( $_GET['mode'] == 'shurl' ){
        $mode = $_GET['mode'];
    } else {
        $mode = 'shurl';
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
    $smarty->display( 'body.tbl' );

    print('<!-- first mode -->');
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
    if( $_GET['org_url'] == '' ){
        $errorflag += 1;
    }
    if( $_GET['shchar'] != '' && strlen($_GET['shchar']) < MINSHCHAR ){
        $errorflag += 1 ;
    }
    if( $errorflag != 0 ){
        header('Location: ./sh.php?mode=error&org_url=' .$_GET['org_url'] . '&shchar=' . $_GET['shchar']);
    }

    if( $_GET['shchar'] == '' ){
        $shchar = hash( 'crc32', $_GET['org_url'] ); // crc32 は8文字にハッシュ
    } else {
        $shchar = $_GET['shchar'];
    }


    $datfile = new DatFile;

    $org_url = $datfile->GetURL( $shchar );
    if( isset( $org_url )){
        // shchar が設定されているので、org_url とか表示してエラー
        $shurl = BASEURL . $shchar;
        $smarty->display( 'header.tbl' );
        $smarty->assign( 'minchar', MINSHCHAR );
        $smarty->assign( 'org_url', $_GET['org_url'] );
        $smarty->assign( 'shchar', $shchar );
        $smarty->assign( 'shurl', $shurl );
        $smarty->assign( 'err_shurl', $shchar . "は" . $org_url . "に設定されています。" );
        $smarty->display( 'body.tbl' );
        exit;
    }

    $datfile->setData( $shchar, $_GET['org_url'] );

    $shurl = BASEURL . $shchar;
    $smarty->display( 'header.tbl' );
    $smarty->assign( 'minchar', MINSHCHAR );
    $smarty->assign( 'org_url', $_GET['org_url'] );
    $smarty->assign( 'shchar', $shchar );
    $smarty->assign( 'shurl', $shurl );
    $smarty->display( 'body.tbl' );

    print( '<!-- gen mode  -->' );
} elseif ( $mode == 'shurl' ){
    /*
      mode=shurl を受け取った
      GET で shchar を取り出し
      NULLかどうかチェック、nullなら mode=first で開きなおし
      shchar で dat を検索
      dat になればエラー画面
      dat にあれば location  hogeで移動
    */

    if( $_GET['shchar'] == "" ){
        header('Location: ./sh.php?mode=first' );
   }

    $datfile = new DatFile;

    $org_url = $datfile->GetURL( $_GET['shchar'] );

    if( $org_url == '' ){
        $smarty->display( 'header.tbl' );
        print( $_GET['shchar'] . "で設定されたURLはありません。" );
    } else {
        header( 'Location: ' .  $org_url );
        print( $org_url );
    }

} elseif( $mode == 'error' ){
    /*
      エラーチェック
    */
    $smarty->display( 'header.tbl' );
    if( $_GET['org_url'] == '' ){
        $smarty->assign( 'err_url', '<span class="help-inline">URLを入力してください。</span>');
    }
    if( $_GET['shchar'] != '' &&  strlen($_GET['shchar']) < MINSHCHAR ){
        $smarty->assign( 'err_shchar', '<span class="help-inline">文字列が短すぎます。</span>');
    }
    $smarty->assign( 'minchar', MINSHCHAR );
    $smarty->assign( 'org_url', $_GET['org_url'] );
    $smarty->assign( 'shchar',  $_GET['shchar'] );
    $smarty->display( 'body.tbl' );


    print( '<!-- error mode -->' ); 
}

$smarty->display( 'footer.tbl' );


?>



 

<?php
    
ini_set( 'display_error', 1 );  // Show error message.
require_once( './libs/Smarty.class.php' );
$smarty = new Smarty();

/*
���åȤ��ѿ�����Ƥ��뤫�ɤ��������å�
 �ѿ����ʤ����ɸ�����
 �ѿ���������ѿ�������å�
   mode=gen �� shurl ��������
   mode=error �ǥ��顼ȯ�������ΤǺ����ϲ���
   mode=shurl �� shurl �������ä��Ȳ��
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

$smarty->display( 'header.tbl' );

if ( $mode == 'first' ){
    /*
      ɸ����̤�ɽ��
      �����ܥ��� �� org_url��shchar��cutoff����GET������
    */
    $smarty->assign( 'org_url', '' );
    $smarty->assign( 'shchar', '' );
    $smarty->display( 'first.tbl' );


} elseif( $mode == 'gen' ){
    /*url��������
      shchar ��̵ͭ�����å�
      shchar �����
      shchar ��Ĺ�������å�
      ���顼�� mode=error ���᤹
      shchar �ʤ���С�org_url,time ��� hash �� shchar ����

      org_url,shchar,day �� dat ����Ͽ

      shurl �β��̤�ɽ��
    */

    $org_url = $_GET['org_url'];
    $shchar = $_GET['shchar'];
    print( 'gen mode' );

} elseif ( $mode == 'shurl' ){
    /*shurl �������ä�
      GET �� shchar ����Ф�
      shchar �� dat �򸡺�
      dat �ˤʤ�Х��顼����
      dat �ˤ���� location  hoge�ǰ�ư
    */

    $shchar = $_GET['shurl'];
    print( 'shurl mode.' );

} elseif( $mode == 'error' ){
    $org_url = $_GET['org_url'];
    $shchar = $_GET['shurl'];
    $cutoff = $_GET['cutoff'];
    print( 'error mode' );

}

$smarty->display( 'footer.tbl' );


?>



 

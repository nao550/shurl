<?php
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

   include( "header.inc" );

   if( $mode == 'gen' ){
       $org_url = $_GET['org_url'];
       $shchar = $_GET['shurl'];
       $cutoff = $_GET['cutoff'];
       print( 'gen mode' );
       
   } elseif ( $mode == 'shurl' ){
       $shchar = $_GET['shurl'];
       print( 'shurl mode.' );

   } elseif ( $mode == 'first' ){
       echo 'first time.';

   } elseif( $mode == 'error' ){
       $org_url = $_GET['org_url'];
       $shchar = $_GET['shurl'];
       $cutoff = $_GET['cutoff'];
       print( 'error mode' );

   }

   include( "footer.inc" );


/*

ɸ����̤�ɽ��
 �����ܥ��� �� org_url��shchar��day����GET������


url��������
 shchar ��̵ͭ�����å�
   shchar �����
     shchar ��Ĺ�������å�
       ���顼�� mode=error ���᤹
   shchar �ʤ���С�org_url,time ��� hash �� shchar ����

 org_url,shchar,day �� dat ����Ͽ

 shurl �β��̤�ɽ��


shurl �������ä�
 GET �� shchar ����Ф�
 shchar �� dat �򸡺�
  dat �ˤʤ�Х��顼����
  dat �ˤ���� location  hoge�ǰ�ư

*/




?>



 

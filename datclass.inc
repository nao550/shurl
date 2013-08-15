<?php

include_once( 'config.php' );

class DatFile
{
    public function SetData( $shchar, $org_url  )
    {
        if( @file_put_contents( DATFILE, $shchar .','. $org_url .','. time() ."\n" , FILE_APPEND | LOCK_EX)){
            echo '<!-- file_put ok -->';
        } else {
            exit( DATFILE . "ファイルの書き込みでエラーが発生しました。 ");
        }
    }

    public function GetURL( $shchar )
    {
        $fp = fopen( DATFILE , 'r' );
        if(! $fp ){
            exit( DATFILE . "ファイルが開けません。");
        }
        while( $data = fgetcsv( $fp )){
            if( $shchar == $data[0] ){
                return $data[1];
            }
        }
    }
}



?>
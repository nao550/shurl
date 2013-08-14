<?php

include_once( 'config.php' );

class DatFile
{
    public function SetData( $shchar, $org_url  )
    {
        if( @file_put_contents( DATFILE, $shchar .','. $org_url .','. time() ."\n" , FILE_APPEND | LOCK_EX)){
            echo '<!-- file_put ok -->';
        } else {
            print( DATFILE . "ファイルの書き込みでエラーが発生しました。 ");
        }
    }

}



?>
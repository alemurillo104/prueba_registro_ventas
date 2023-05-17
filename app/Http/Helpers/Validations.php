<?php 

namespace App\Http\Helpers;

class Validations{

    public static function getErrorMessages( array $array )
    {
        $resp = '';
        foreach ($array as $key => $error) {
            $resp .= $error[0] . ", ";
        }

        $resp = substr_replace($resp, "!", strlen($resp) -2, strlen($resp) -1 );

        return $resp;
    }
}

?>
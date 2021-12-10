<?php 
namespace App\Utilities;

use App\Models\BaseModels\View;

class Functions{

    public static $errorsSet;
    public static $errorSepreator = "<myErrorSeprator>";

    public static function errors($messages = '',$sep = ''){
        $allErrors = '';
        if($sep == '')
            $sep = self::$errorSepreator;
        if($messages == '')
            $messages = self::$errorsSet;
        else
            $messages .= self::$errorsSet;

        $errors = explode($sep,$messages);
        foreach ($errors as $error)
            $allErrors .= $error . "<br />";
        return $allErrors;
    }

    public function myTrim($value,$find = '',$replace = '')
    {
        ($find !== '' && isset($find) && !empty($find)) ? $find = $find : $find = ' ';
        ($replace !== '' && isset($replace) && !empty($replace)) ? $replace = $replace: $replace = '';
        return str_replace($find,$replace,$value);
    }

    public function view($path,$data = []){
        return View::view($path,$data);
    }
}

?>
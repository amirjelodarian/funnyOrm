<?php
namespace App\Utilities;

use App\Utilities\Functions as UtilitiesFunctions;


function errors($message,$sep = ''){
    echo UtilitiesFunctions::errors($message,$sep);
}
function myTrim($value,$find = '',$replace = ''){
    return UtilitiesFunctions::myTrim($value,$find,$replace);
}
?>
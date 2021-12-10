<?php
namespace App\Utilities;

use App\Models\BaseModels\View;
use App\Utilities\Functions as UtilitiesFunctions;



function errors($message,$sep = ''){
    echo UtilitiesFunctions::errors($message,$sep);
}
function myTrim($value,$find = '',$replace = ''){
    return UtilitiesFunctions::myTrim($value,$find,$replace);
}
function view($path,$data = []){
    return UtilitiesFunctions::view($path,$data);
}
?>
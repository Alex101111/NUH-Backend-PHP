<?php

use Core\JsonWebToken;

require_once implode(DIRECTORY_SEPARATOR, ['..', 'config', 'setup.php']);
require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'vendor', 'autoload.php']);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// check the incoming request link and Method used 

$requestUrl = filter_input(INPUT_SERVER,"REQUEST_URI");
$requestMethod = filter_input(INPUT_SERVER,"REQUEST_METHOD");
$router = new AltoRouter();
$jwt = new JsonWebToken;

if(isset($_SERVER["HTTP_AUTHORIZATION"])){


    $headerToken = $jwt->getHeaderToken();
if($jwt->is_jwt_valid($headerToken)){

    if($jwt->isAdmin($headerToken) ){
        require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'AdminRoutes.php']);
    //  echo   json_encode('admin or sth' );
    }else{
        require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'UserRoutes.php']);
    //   echo  json_encode('user or sth' );
    }
}else{
    header('HTTP/1.0 400 Bad Request');
    echo json_encode( 'Token not found in request');
}
}else{
    require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'VisitorRoutes.php']);


}


// // json_encode(var_dump($_SERVER['HTTP_AUTHORIZATION']));


 
// // }else{
//     if( str_contains($requestUrl,"/admin")){

//         }
//         if( str_contains($requestUrl,"/user")){
//             require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'UserRoutes.php']);
//             }    
// //   }    

// // }

$match = $router->match($requestUrl,$requestMethod);

if(is_array($match) && is_callable($match['target'])){
    call_user_func_array($match['target'], $match['params']);
}elseif(is_bool($match) && !$match){
    
    json_encode('Error 404' );
}
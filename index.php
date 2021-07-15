<?php
header("Access-Control-Allow-Origin: https://tarkov.help/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'services/db.php';
include_once 'classes/token.php';
include_once 'classes/item.php';

$token = null;
$headers = apache_request_headers();

if (isset($headers['Authorization'])) {
    $matches = array();

    preg_match('/Token token="(.*)"/', $headers['Authorization'], $matches);

    if (isset($matches[1])) {
        $token = $matches[1];
    }
}

if (!empty($token)) {
    http_response_code(400);

    echo json_encode(array("message" => "Не указан токен авторизации."));

    die('Request without token');
}

$database = new Database();
$db = $database->getConnection();

$tokenObj = new Token($db);

$tokenObj->token = $token;

if (!$tokenObj->exists()) {
    http_response_code(401);

    echo json_encode(array("message" => "Токен не существует в базе данных."));

    die('Request with invalid token');
}

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

$item = new Item($db);

// из урла вида /api/items/%itemname% мы получим %itemname% 
$item->name = $uri_segments[2];

if ($item->exists()) {
    http_response_code(200);

    echo json_encode($item->toArray());
}

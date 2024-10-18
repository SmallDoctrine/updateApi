<?php


global $pdo; //for pgsql connection
require 'config/database.php';
require 'models/Game.php';
require 'repositories/GameRepository.php';
require 'services/GameService.php';
require 'controllers/GameController.php';

$repository = new GameRepository($pdo);
$service = new GameService($repository);
$controller = new GameController($service);

header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/') );


if ($requestUri[0] !== 'games')
{
    http_response_code(404);
    echo json_encode(['message' => 'укажите правильный URI']);
    exit;
}
switch ($requestMethod) {
    case 'GET':
        if
        // можно так же заместо агрегатной функции count проверять кол-во через isset requestUri[1] и т.п
        (count($requestUri) == 1)
        {
            echo $controller->getAllGames();
        }
        elseif
        (count($requestUri) == 2)
        {
            echo $controller->getGameById($requestUri[1]);
        }
        elseif
        (count($requestUri) == 3  && $requestUri[1] === 'genres')
        {
            echo $controller->getGamesByGenre($requestUri[2]);
        }
        break ;

    case 'POST':
            echo $controller->addGame();
        break ;

    case 'PUT':
        echo $controller->updateGame($requestUri[1]);
    break ;

    case 'DELETE':
            echo $controller->deleteGame($requestUri[1]);
        break ;

    default:
        http_response_code(405);
        echo json_encode(['упс , ошибочка ' => ' вы выбрали недопустимый метод']);
        break;
}

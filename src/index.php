<?php

require __DIR__ . '/UDPT/controller/home.php';
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];
$controller = new controller();

// Xử lý route
switch ($request_method) {
    case 'GET':
        switch ($request_uri) {
            case '/':
                $controller->login();
                include('./udpt/view/home.php');
                break;
            case '/signup':
                $controller->signup();
                break;
            case '/home':
                include('./udpt/view/home.php');
                break;
            case '/danh-sach-tra-loi-moi-nhat':
                $controller->getLast3Answers();
                break;
            case '/danh-sach-danh-gia-moi-nhat':
                $controller->getLast3Rate();
                break;
            case '/login':
                $controller->login();
                break;
            case '/create-question':
                $controller->get_create_question();
                break;
            case '/list-question':
                $controller->list_question();
                break;
            case '/change/Admin':
                $controller->change('Admin');
                break;
            case '/change/Questioner':
                $controller->change('Questioner');
                break;
            case '/change/Answerer':
                $controller->change('Answerer');
                break;
            case '/change/Evaluater':
                $controller->change('Evaluater');
                break;
            default:
                if (preg_match('/^\/list-question\/detail\/(\d+)$/', $request_uri, $matches)) {
                    $QuestionID = $matches[1];
                    $controller->list_question_detail($QuestionID);
                } else {
                    // Route không hợp lệ
                    echo '404 Not Found';
                }
        }
        break;
    case 'POST':
        switch ($request_uri) {
            case '/login':
                $controller->checkLogin();
                break;
            case '/create-question':
                $controller->create_question();
                break;
            case '/list-question/search':
                $controller->search();
                break;
            case '/add-answer':
                $controller->add_answer();
                break;
            case '/signup':
                include('./udpt/php/api/post/signup.php');
                break;
            default:
                // Route không hợp lệ
                echo '404 Not Found';
        }
        break;
    default:
        // Route không hợp lệ
        echo '404 Not Found';
}
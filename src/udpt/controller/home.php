<?php

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Answers.php';
require_once __DIR__ . '/../model/Questions.php';
require_once __DIR__ . '/../model/Answer_Evaluates.php';
$User = new User("", "", "", "");
class Controller
{
    // public $dir = '../view/';
    public function login()
    {
        session_start();

        // Xoá tất cả các biến session và dữ liệu session được lưu trữ
        session_destroy();
        require(__DIR__ . '/../view/login.php');
    }
    public function get_create_question()
    {
        require(__DIR__ . '/../view/create_question.php');
    }
    public function create_question()
    {
        {
            // Nhận chuỗi JSON từ phương thức POST
            $question = $_POST['question'];
            $tags = $_POST['tags'];
            $UserID = $_POST['UserID'];
            $currentDateTime = new DateTime();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
            $Question = new Question("", $question, $UserID, $tags, $formattedDateTime, 0);
            $result = $Question->create();
            if ($result == 1) {
                // Đăng nhập thành công
                // $data = array();
                // $response = array(
                //     'result' => 1,
                //     'data' => $data
                // );
                // header("Location: http://localhost/signup");
                header("Location: http://localhost/list-question");
                // echo json_encode($response, JSON_UNESCAPED_UNICODE);
                // $this->handleRequest('GET', 'login');
            } else {
                // Đăng nhập không thành công
                // $this->handleRequest('GET', 'signup');
                echo "Thất bại";
                // echo "Invalid email or password!";
            }
        }
    }
    public function list_question()
    {
        session_start();

        $Question = new Question("", "", "", "", "", 0);
        $_SESSION['list_question'] = $Question->get_list_question();
        $User = new User("", "", "", "");
        $list_user = $User->list_user();
        $_SESSION['list_user'] = $list_user;
        // $length = count($_SESSION['list_question']);
        // echo "Độ dài của mảng là: " . $length;
        // for ($i = 0; $i < $length; $i++) {
        //     echo "UserID: " . $_SESSION['list_question'][$i]['UserID'] . '<br>';
        //     echo "Câu hỏi: " . $_SESSION['list_question'][$i]['Question'] . '<br>';
        //     echo "Tags: " . $_SESSION['list_question'][$i]['Tags'] . '<br>';
        //     echo "<br>";
        // }
        // return;
        require(__DIR__ . '/../view/list_question.php');

    }
    public function search()
    {
        {
            $username = $_POST['username'];
            $tags = $_POST['tags'];
            $Question = new Question("", "", "", "", "", 0);
            $_SESSION['list_question'] = $Question->get_list_question_search($username, $tags);
            $User = new User("", "", "", "");
            $list_user = $User->list_user();
            $_SESSION['list_user'] = $list_user;
            // $length = count($_SESSION['list_question']);
            // echo "Độ dài của mảng là: " . $length;
            // for ($i = 0; $i < $length; $i++) {
            //     echo "UserID: " . $_SESSION['list_question'][$i]['UserID'] . '<br>';
            //     echo "Câu hỏi: " . $_SESSION['list_question'][$i]['Question'] . '<br>';
            //     echo "Tags: " . $_SESSION['list_question'][$i]['Tags'] . '<br>';
            //     echo "<br>";
            // }
            // return;
            require(__DIR__ . '/../view/list_question.php');
        }
    }
    public function list_question_detail($QuestionID)
    {
        session_start();
        // echo $_SESSION['User']['Role'];
        // return;
        $_SESSION['QuestionID'] = $QuestionID;
        $Question = new Question("", "", "", "", "", 0);
        $_SESSION['question'] = $Question->get_question($QuestionID);
        $answer = new Answer("", "", "", "", "", "", "");
        $_SESSION['list_answer'] = $answer->list_answer_by_questionid($QuestionID);
        $User = new User("", "", "", "");
        $list_user = $User->list_user();
        $_SESSION['list_user'] = $list_user;
        // $_SESSION['User'] = $User->get_user_by_id($_SESSION['question']->UserID);
        require(__DIR__ . '/../view/list_question_detail.php');
        // $length = count($_SESSION['list_answer']);
        // for ($i = 0; $i < $length; $i++) {
        //     echo "Answer: " . $_SESSION['list_answer'][$i]['Answer'] . '<br>';
        //     echo "<br>";
        // }
        // return;
    }
    public function add_answer()
    {
        {
            // Nhận chuỗi JSON từ phương thức POST
            $QuestionID = $_POST['QuestionID'];
            $UserID = $_POST['UserID'];
            $answerText = $_POST['Answer'];
            $Reference = $_POST['Reference'];
            $currentDateTime = new DateTime();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
            echo $QuestionID;
            echo $UserID;
            echo $answerText;
            echo $formattedDateTime;
            // return;
            $Answer = new Answer("", $QuestionID, $answerText, $Reference, $UserID, $formattedDateTime, 0);
            $result = $Answer->create();
            if ($result == 1) {
                header("Location: http://localhost/list-question/detail/" . $QuestionID);
            } else {
                echo "Thất bại";
            }
        }
    }
    public function checkLogin()
    {
        // Nhận chuỗi JSON từ phương thức POST
        // $jsonString = $_POST['json'];

        // Giải mã chuỗi JSON thành một mảng
        // $data = json_decode($jsonString, true);

        // Lấy email từ mảng dữ liệu
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Tạo đối tượng account
        $User = new User("", "", "", "");

        // Gọi hàm login từ đối tượng account
        $result = $User->login($username, $password);

        if ($result == 1) {
            session_start();
            $_SESSION['User'] = $User->get_user_by_username($username);
            header("Location: http://localhost/home");
        } else {
            echo 'Sai tên đăng nhập hoặc mật khẩu';
            header("Location: http://localhost/login");
            // Đăng nhập không thành công
            // $this->handleRequest('GET', 'signup');
            // require(__DIR__ . '/../view/signup.php');
            // echo "Invalid email or password!";
        }
    }
    public function change($role)
    {
        session_start();
        $user = $_SESSION['User'];
        if (!isset($user['Role_Real'])) {
            $user['Role_Real'] = $user['Role'];
        }
        $user['Role'] = $role;
        $_SESSION['User'] = $user;
        header("Location: http://localhost/home");
    }
    public function getLast3Answers()
    {
        $answer = new Answer("", "", "", "", "", "", 0);
        $_SESSION['last3_answer'] = $answer->getLast3Answers();
        require(__DIR__ . '/../view/last3answer.php');
    }
    public function getLast3Rate()
    {
        $answer = new Answer_Evaluates("", "", "", "", "");
        $_SESSION['last3_rate'] = $answer->getLast3Rate();
        require(__DIR__ . '/../view/last3rate.php');
    }
    public function signup()
    {
        require(__DIR__ . '/../view/signup.php');
    }

    public function loginPost()
    {
        require('./udpt/php/api/post/login.php');
    }

    public function showLogin()
    {
        require('./udpt/view/login.php');
    }

    public function changePassword()
    {
        require('./udpt/php/changepassword.php');
    }

    public function changePasswordPost()
    {
        require('./udpt/php/api/post/changepassword.php');
    }

    public function signupPost()
    {
        require('./udpt/php/api/post/signup.php');
    }

    public function handleRequest($request_method, $request_uri)
    {
        $routes = [
            '/' => 'login',
            '/signup' => 'signup',
            '/login' => 'showLogin',
            '/changepassword' => 'changePassword',
            '/login' => 'showLogin',
            '/api/login' => 'loginPost',
            '/api/changepassword' => 'changePasswordPost',
            '/api/signup' => 'signupPost'
        ];

        $route = rtrim($request_uri, '/');

        if (array_key_exists($route, $routes)) {
            $method = $routes[$route];
            if (method_exists($this, $method)) {
                $this->$method();
                return;
            }
        }

        $this->defaultRoute();
    }

    private function defaultRoute()
    {
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $uri = 'https://';
        } else {
            $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        header('Location: ' . $uri . '/dashboard/');
        exit;
    }
}

// $request_uri = $_SERVER['REQUEST_URI'];
// $request_method = $_SERVER['REQUEST_METHOD'];

// $controller = new Controller();
// $controller->handleRequest($request_method, $request_uri);

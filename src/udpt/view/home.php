<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Trang chuyển hướng</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        padding: 20px;
        background-color: #333;
        color: #fff;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    li {
        display: inline-block;
        margin: 10px;
    }

    a {
        display: block;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    a:hover {
        background-color: #555;
    }

    select {
        padding: 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        appearance: none;
        background-color: #fff;
        color: #333;
    }

    select option {
        background-color: #fff;
        color: #333;
    }
    </style>
</head>

<body>
    <h1>Trang chuyển hướng</h1>

    <ul>
        <li><a href="/create-question">Đặt câu hỏi</a></li>
        <li><a href="/list-question">Danh sách câu hỏi</a></li>

        <?php if ((!array_key_exists('User', $_SESSION) ||$_SESSION['User']['Role'] === 'Evaluater' || $_SESSION['User']['Role'] === 'Admin')) : ?>
        <li><a href="/danh-sach-danh-gia-moi-nhat">Danh sách đánh giá mới nhất</a></li>
        <?php endif; ?>

        <?php if (!array_key_exists('User', $_SESSION) || $_SESSION['User']['Role'] === 'Evaluater' || $_SESSION['User']['Role'] === 'Admin') : ?>
        <li><a href="/danh-sach-tra-loi-moi-nhat">Danh sách trả lời mới nhất</a></li>
        <?php endif; ?>

        <li>
            <form id="roleForm" method="POST" action="/change">
                <ul>
                    <li>
                        <select name="role" style="padding:10px;" onchange="submitForm(this.value)">
                            <option value="/change/Admin" <?php if (!array_key_exists('User', $_SESSION) || $_SESSION['User']['Role'] === 'Admin') {
                                echo 'selected';
                            } ?>>
                                Admin
                            </option>
                            <option value="/change/Questioner" <?php if (!array_key_exists('User', $_SESSION) || $_SESSION['User']['Role'] === 'Questioner') {
                                echo 'selected';
                            } ?>>
                                Questioner
                            </option>
                            <option value="/change/Answerer" <?php if (!array_key_exists('User', $_SESSION) || $_SESSION['User']['Role'] === 'Answerer') {
                                echo 'selected';
                            } ?>>
                                Answerer
                            </option>
                            <option value="/change/Evaluater" <?php if (!array_key_exists('User', $_SESSION) || $_SESSION['User']['Role'] === 'Evaluater') {
                                echo 'selected';
                            } ?>>
                                Evaluater
                            </option>
                        </select>
                    </li>
                </ul>
            </form>
        </li>
        <script>
        function submitForm(value) {
            location.href = value;
        }
        </script>
    </ul>

</body>

</html>
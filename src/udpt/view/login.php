<?php
// Kiểm tra nếu có thông báo lỗi trong URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
}
?>

<!-- Tiếp tục code HTML của trang login -->

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
        margin: 0 auto;
        /* Add this line to center the container */
        display: flex;
        justify-content: center;
        /* max-width: 800px; Set a maximum width for the container */
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    /* @media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
} */
    .center {
        text-align: center;
        font-size: 30px
    }
    </style>
</head>

<body>

    <h2 class='center'>Login Form</h2>
    <div class="container">
        <form action="/login" method="post" style="width:50%">
            <div class="imgcontainer">
                <img src="https://vectorified.com/images/user-picture-icon-18.png" alt="Avatar" class="avatar"
                    style="height:60px;width:80px;">
            </div>

            <div class="container">
                <div>
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <div style="text-align:center">
                    <!-- <span class="psw"><a href="#">Sign up </a></span> -->
                    <span class="psw"><a href="#">Forgot password?</a></span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
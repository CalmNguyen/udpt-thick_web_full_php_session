<!DOCTYPE html>
<html>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

* {
    box-sizing: border-box
}

/* Full-width input fields */
input[type=text],
input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus,
input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
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
    opacity: 0.9;
}

button:hover {
    opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,
.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {

    .cancelbtn,
    .signupbtn {
        width: 100%;
    }
}

.form-container {
    width: 60%
}

.center {
    display: flex;
    justify-content: center;
}
</style>

<body class="center">

    <form id="signupForm" style="border:1px solid #ccc" class="form-container">
        <div class="container">
            <h1>Sign Up</h1>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="password-repeat" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

            <div class="clearfix center">
                <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </div>
    </form>

    <script src="../ventor/jquery/jquery.min.js"></script>
    <script src="../ventor/jquery/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // Khi form submit
        $("#signupForm").submit(function(event) {
            event.preventDefault(); // Ngăn chặn form submit mặc định

            // Lấy dữ liệu từ form
            var formData = {
                email: $("input[name=email]").val(),
                password: $("input[name=password]").val(),
                password_repeat: $("input[name=password-repeat]").val(),
                is_locked: ""
            };

            // Gửi yêu cầu POST đến API
            $.ajax({
                type: "POST",
                url: "http://localhost/signup", // Đường dẫn tới file API sign up
                data: JSON.stringify(formData),
                contentType: "application/json",
                dataType: "json",
                success: function(response) {
                    // Xử lý phản hồi từ API
                    if (response.result == 1) {
                        alert("Sign up successful");
                        // Thực hiện các hành động khác sau khi đăng ký thành công
                    } else {
                        alert("Sign up failed: " + response.message);
                        // Xử lý lỗi nếu cần
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error: " + status, error);
                    // Xử lý lỗi nếu cần
                }
            });

            return false; // Ngăn chặn chuyển hướng trang
        });
    });
    </script>


</body>

</html>
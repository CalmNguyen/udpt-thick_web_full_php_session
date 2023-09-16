<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm câu hỏi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Thêm câu hỏi</h2>
        <form action="/create-question" method="POST">
            <input type="hidden" name="UserID" id="UserID" value="<?php echo $_SESSION['User']['UserID']; ?>">

            <div class="form-group">
                <label for="question">Câu hỏi:</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags" required>
            </div>
            <?php if (array_key_exists('User', $_SESSION)&&($_SESSION['User']['Role']=='Questioner')&&(!isset($user['Role_Real']) || (isset($user['Role_Real']) && $_SESSION['User']['Role']==$_SESSION['User']['Role_Real']))) : ?>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <?php endif; ?>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
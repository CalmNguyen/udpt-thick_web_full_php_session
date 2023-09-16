<?php
// session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Tùy chỉnh CSS styles */
    </style>
</head>
<style>
.padding10 {}
</style>

<body>

    <h1>List question</h1>

    <form style="padding:10px;" method="POST" action="/list-question/search">
        <div class="form-row align-items-center">
            <div class="col-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="col-3">
                <label for="tags">Tags:</label>
                <input type="text" class="form-control" id="tags" name="tags">
            </div>
            <div class="col-auto" style="display: flex; justify-content: center;line-height:90px;">
                <button type="submit" class="btn btn-primary"
                    style="margin-top:30px;padding-left:30px;padding-right:30px">Search</button>
            </div>
        </div>
    </form>



    <table class="table table-striped padding10">
        <thead>
            <tr style="background-color:black;color:white;">
                <th>STT</th>
                <th>UserName</th>
                <th>Question</th>
                <th>Tags</th>
                <th>Created Date</th>
                <th>Number of Answer</th>
                <th>View Answer</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sử dụng vòng lặp để hiển thị danh sách câu hỏi -->
            <!-- Sử dụng vòng lặp để hiển thị danh sách câu hỏi -->
            <?php foreach ($_SESSION['list_question'] as $index => $question): ?>
            <?php
    // Tìm người dùng dựa trên UserID trong danh sách người dùng
    $user = null;
                foreach ($_SESSION['list_user'] as $userData) {
                    if ($userData['UserID'] === $question['UserID']) {
                        $user = $userData;
                        break;
                    }
                }

                // Kiểm tra xem người dùng có tồn tại không
                if ($user !== null) {
                    $userName = $user['UserName'];
                } else {
                    $userName = 'Unknown'; // hoặc giá trị mặc định khác nếu không tìm thấy người dùng
                }
                ?>

            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $userName; ?></td>
                <td><?php echo $question['Question']; ?></td>
                <td><?php echo $question['Tags']; ?></td>
                <td><?php echo $question['CreatedDate']; ?></td>
                <td><?php echo $question['NumberAnswerers']; ?></td>
                <th><a href="/list-question/detail/<?php echo $question['QuestionID']; ?>">Answers</a></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
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
.title {
    display: flex;
    flex-direction: row;
    align-items: center;
}
</style>

<body>
    <div>
        <h3 style="margin:30px; text-align:center;">Question: <?php echo $_SESSION['question']->Question ?></h3>
    </div>
    <?php if (array_key_exists('User', $_SESSION)&&($_SESSION['User']['Role'] == 'Answerer' || $_SESSION['User']['Role'] == 'Admin') && (!isset($_SESSION['User']['Role_Real']) || (isset($_SESSION['User']['Role_Real']) && $_SESSION['User']['Role']==$_SESSION['User']['Role_Real']))) : ?>
    <div style="display: flex;align-items: flex-start;padding:auto;margin:10px">
        <strong>Add new answer</strong>
    </div>
    <?php endif; ?>
    <?php if (array_key_exists('User', $_SESSION)&&($_SESSION['User']['Role'] == 'Answerer' || $_SESSION['User']['Role'] == 'Admin')&&(!isset($_SESSION['User']['Role_Real']) || (isset($_SESSION['User']['Role_Real']) && $_SESSION['User']['Role']==$_SESSION['User']['Role_Real']))) : ?>
    <div class="title">
        <button id="addAnswerBtn" class="btn btn-primary" style="font-size:20px;float:left;margin:20px;margin-top: 0px;"
            data-toggle="modal" data-target="#answerModal">+</button>
    </div>
    <?php endif; ?>
    <table class="table table-striped padding10">
        <thead>
            <tr style="background-color:black;color:white;">
                <th>STT</th>
                <th>User Name</th>
                <th>Answer</th>
                <th>Created Date</th>
                <?php if (array_key_exists('User', $_SESSION)&&($_SESSION['User']['Role'] === 'Evaluater' || $_SESSION['User']['Role'] === 'Admin')&&(!isset($_SESSION['User']['Role_Real']) || (isset($_SESSION['User']['Role_Real']) && $_SESSION['User']['Role']==$_SESSION['User']['Role_Real']))) : ?>
                <th>Rate</th>
                <?php endif; ?>
                <!-- <th>Trả lời</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- Sử dụng vòng lặp để hiển thị danh sách câu hỏi -->
            <?php foreach ($_SESSION['list_answer'] as $index => $answer): ?>
            <?php
                // Tìm người dùng dựa trên UserID trong danh sách người dùng
                $user = null;
                foreach ($_SESSION['list_user'] as $userData) {
                    if ($userData['UserID'] === $answer['UserID']) {
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
                <td><?php echo $answer['Answer']; ?></td>
                <td><?php echo $answer['CreatedDate']; ?></td>
                <?php if (array_key_exists('User', $_SESSION)&&($_SESSION['User']['Role'] === 'Evaluater' || $_SESSION['User']['Role'] === 'Admin')&&(!isset($_SESSION['User']['Role_Real']) || (isset($_SESSION['User']['Role_Real']) && $_SESSION['User']['Role']==$_SESSION['User']['Role_Real']))) : ?>
                <td><select class="custom-select" id="inputGroupSelect01">
                        <option selected>Chose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <form action='/add-answer' method="POST" class="modal fade" id="answerModal" tabindex="-1" role="dialog"
        aria-labelledby="answerModalLabel" aria-hidden="true">
        <input type="hidden" class="form-control" name="QuestionID" id="QuestionID"
            value="<?php echo isset($_SESSION['QuestionID']) ? $_SESSION['QuestionID'] : ''; ?>">
        <input type="hidden" class="form-control" name="UserID" id="UserID"
            value="<?php echo isset($_SESSION['question']->UserID) ? $_SESSION['question']->UserID : ''; ?>">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="answerModalLabel">Add new answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="Answer" id="Answer" placeholder="Enter your answer">
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="Reference" id="Reference"
                        placeholder="Enter reference">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#addAnswerBtn').click(function() {
            $('#answerModal').modal('show');
        });
    });
    </script>
</body>

</html>
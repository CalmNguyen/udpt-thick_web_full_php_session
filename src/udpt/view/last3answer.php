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
        <h3 style="margin:30px; text-align:center;">Latest answer list</h3>
    </div>

    <table class="table table-striped padding10">
        <thead>
            <tr style="background-color:black;color:white;">
                <th>STT</th>
                <th>Answer</th>
                <th>Created Date</th>
                <th>Action</th>
                <!-- <th>Trả lời</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- Sử dụng vòng lặp để hiển thị danh sách câu hỏi -->
            <?php foreach ($_SESSION['last3_answer'] as $index => $answer): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $answer['Answer']; ?></td>
                <td><?php echo $answer['CreatedDate']; ?></td>
                <th><a href="/list-question/detail/<?php echo $answer['QuestionID']; ?>">Question</a></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


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
<?php

require_once 'dbconn.php';

class Question
{
    private $QuestionID;
    private $Question;
    private $UserID;
    private $Tags;
    private $CreatedDate;
    private $NumberAnswerers;
    private $dbConnection;

    public function __construct($QuestionID, $Question, $UserID, $Tags, $CreatedDate, $NumberAnswerers)
    {
        $this->QuestionID = $QuestionID;
        $this->Question = $Question;
        $this->UserID = $UserID;
        $this->Tags = $Tags;
        $this->CreatedDate = $CreatedDate;
        $this->NumberAnswerers = $NumberAnswerers;
        $this->dbConnection = dbconn::getInstance()->getConnection();
    }

    // Getter methods

    public function getQuestionID()
    {
        return $this->QuestionID;
    }

    public function getQuestion()
    {
        return $this->Question;
    }

    public function getUserID()
    {
        return $this->UserID;
    }

    public function getTags()
    {
        return $this->Tags;
    }

    public function getCreatedDate()
    {
        return $this->CreatedDate;
    }

    public function getNumberAnswerers()
    {
        return $this->NumberAnswerers;
    }

    // Setter methods

    public function setQuestionID($QuestionID)
    {
        $this->QuestionID = $QuestionID;
    }

    public function setQuestion($Question)
    {
        $this->Question = $Question;
    }

    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }

    public function setTags($Tags)
    {
        $this->Tags = $Tags;
    }

    public function setCreatedDate($CreatedDate)
    {
        $this->CreatedDate = $CreatedDate;
    }

    public function setNumberAnswerers($NumberAnswerers)
    {
        $this->NumberAnswerers = $NumberAnswerers;
    }

    public function update()
    {
        $QuestionID = $this->QuestionID;
        $Question = $this->Question;
        $UserID = $this->UserID;
        $Tags = $this->Tags;
        $CreatedDate = $this->CreatedDate;
        $NumberAnswerers = $this->NumberAnswerers;

        $query = "UPDATE questions SET Question = '$Question', UserID = '$UserID', Tags = '$Tags', CreatedDate = '$CreatedDate', NumberAnswerers = '$NumberAnswerers' WHERE QuestionID = '$QuestionID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Update successful
        } else {
            return 0; // Update failed
        }
    }

    public function create()
    {
        $Question = $this->Question;
        $UserID = $this->UserID;
        $Tags = $this->Tags;
        $CreatedDate = $this->CreatedDate;
        $NumberAnswerers = $this->NumberAnswerers;

        $query = "INSERT INTO questions (Question, UserID, Tags, CreatedDate, NumberAnswerers) VALUES ('$Question', '$UserID', '$Tags', '$CreatedDate', '$NumberAnswerers')";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Create successful
        } else {
            return 0; // Create failed
        }
    }

    public function delete()
    {
        $QuestionID = $this->QuestionID;

        $query = "DELETE FROM questions WHERE QuestionID = '$QuestionID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Delete successful
        } else {
            return 0; // Delete failed
        }
    }
    public function get_list_question()
    {
        $query = "SELECT * FROM QUESTIONS";
        $result = mysqli_query($this->dbConnection, $query);

        $questionList = array(); // Mảng chứa danh sách câu hỏi

        while ($row = mysqli_fetch_assoc($result)) {
            $questionList[] = $row; // Thêm bản ghi vào mảng
        }

        return $questionList;
    }
    public function get_list_question_search($username, $tags)
    {
        $query = "SELECT q.*, u.UserName 
                  FROM questions AS q
                  INNER JOIN users AS u ON q.UserID = u.UserID
                  WHERE u.UserName LIKE '%$username%' AND q.Tags LIKE '%$tags%'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result === false) {
            echo "Error: " . mysqli_error($this->dbConnection);
            return false;
        }

        $questionList = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $questionList[] = $row;
        }

        return $questionList;
    }


    public function get_question($QuestionID)
    {
        $query = "SELECT * FROM QUESTIONS WHERE QuestionID=$QuestionID";
        $result = mysqli_query($this->dbConnection, $query);
        $row = mysqli_fetch_object($result);
        return $row;
        $question = null; // Đối tượng câu hỏi

        if ($row = mysqli_fetch_object($result)) {
            $question = $row; // Gán đối tượng câu hỏi
        }

        return $question;
    }
}

$dbConnection = dbconn::getInstance();
$conn = $dbConnection->getConnection();

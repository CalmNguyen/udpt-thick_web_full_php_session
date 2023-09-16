<?php

require_once 'dbconn.php';

class Answer
{
    private $AnswerID;
    private $QuestionID;
    private $Answer;
    private $Reference;
    private $UserID;
    private $CreatedDate;
    private $NumberEvaluaters;
    private $dbConnection;

    public function __construct($AnswerID, $QuestionID, $Answer, $Reference, $UserID, $CreatedDate, $NumberEvaluaters)
    {
        $this->AnswerID = $AnswerID;
        $this->QuestionID = $QuestionID;
        $this->Answer = $Answer;
        $this->Reference = $Reference;
        $this->UserID = $UserID;
        $this->CreatedDate = $CreatedDate;
        $this->NumberEvaluaters = $NumberEvaluaters;
        $this->dbConnection = dbconn::getInstance()->getConnection();
    }

    // Getter methods

    public function getAnswerID()
    {
        return $this->AnswerID;
    }

    public function getQuestionID()
    {
        return $this->QuestionID;
    }

    public function getAnswer()
    {
        return $this->Answer;
    }

    public function getReference()
    {
        return $this->Reference;
    }

    public function getUserID()
    {
        return $this->UserID;
    }

    public function getCreatedDate()
    {
        return $this->CreatedDate;
    }

    public function getNumberEvaluaters()
    {
        return $this->NumberEvaluaters;
    }

    // Setter methods

    public function setAnswerID($AnswerID)
    {
        $this->AnswerID = $AnswerID;
    }

    public function setQuestionID($QuestionID)
    {
        $this->QuestionID = $QuestionID;
    }

    public function setAnswer($Answer)
    {
        $this->Answer = $Answer;
    }

    public function setReference($Reference)
    {
        $this->Reference = $Reference;
    }

    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }

    public function setCreatedDate($CreatedDate)
    {
        $this->CreatedDate = $CreatedDate;
    }

    public function setNumberEvaluaters($NumberEvaluaters)
    {
        $this->NumberEvaluaters = $NumberEvaluaters;
    }
    public function list_answer_by_questionid($QuestionID)
    {
        $query = "SELECT * FROM Answers where QuestionID=$QuestionID";
        $result = mysqli_query($this->dbConnection, $query);

        $answerList = array(); // Mảng chứa danh sách câu hỏi

        while ($row = mysqli_fetch_assoc($result)) {
            $answerList[] = $row; // Thêm bản ghi vào mảng
        }

        return $answerList;
    }
    public function getLast3Answers()
    {
        $query = "SELECT * FROM Answers ORDER BY CreatedDate DESC LIMIT 3";
        $result = mysqli_query($this->dbConnection, $query);

        $answerList = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $answerList[] = $row;
        }

        return $answerList;
    }

    public function update()
    {
        $AnswerID = $this->AnswerID;
        $QuestionID = $this->QuestionID;
        $Answer = $this->Answer;
        $Reference = $this->Reference;
        $UserID = $this->UserID;
        $CreatedDate = $this->CreatedDate;
        $NumberEvaluaters = $this->NumberEvaluaters;

        $query = "UPDATE answer SET QuestionID = '$QuestionID', Answer = '$Answer', Reference = '$Reference', UserID = '$UserID', CreatedDate = '$CreatedDate', NumberEvaluaters = '$NumberEvaluaters' WHERE AnswerID = '$AnswerID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Update successful
        } else {
            return 0; // Update failed
        }
    }

    public function create()
    {
        $QuestionID = $this->QuestionID;
        $Answer = $this->Answer;
        $Reference = $this->Reference;
        $UserID = $this->UserID;
        $CreatedDate = $this->CreatedDate;
        $NumberEvaluaters = $this->NumberEvaluaters;

        $query = "INSERT INTO answers (QuestionID, Answer, Reference, UserID, CreatedDate, NumberEvaluaters) VALUES ('$QuestionID', '$Answer', '$Reference', '$UserID', '$CreatedDate', '$NumberEvaluaters')";

        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            $countQuery = mysqli_query($this->dbConnection, "SELECT numberanswerers FROM questions WHERE questionid = $QuestionID");
            $countResult = mysqli_fetch_assoc($countQuery);
            $count = $countResult['numberanswerers'] + 1;
            mysqli_query($this->dbConnection, "UPDATE questions SET numberanswerers = $count WHERE questionid = $QuestionID");
            return 1; // Create successful
        } else {
            return 0; // Create failed
        }
    }

    public function delete()
    {
        $AnswerID = $this->AnswerID;

        $query = "DELETE FROM answer WHERE AnswerID = '$AnswerID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Delete successful
        } else {
            return 0; // Delete failed
        }
    }
}

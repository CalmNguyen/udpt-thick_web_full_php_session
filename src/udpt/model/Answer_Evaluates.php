<?php

require_once 'dbconn.php';

class Answer_Evaluates
{
    private $EvaluateID;
    private $AnswerID;
    private $UserID;
    private $CreatedDate;
    private $RateCategory;
    private $dbConnection;

    public function __construct($EvaluateID, $AnswerID, $UserID, $CreatedDate, $RateCategory)
    {
        $this->EvaluateID = $EvaluateID;
        $this->AnswerID = $AnswerID;
        $this->UserID = $UserID;
        $this->CreatedDate = $CreatedDate;
        $this->RateCategory = $RateCategory;
        $this->dbConnection = dbconn::getInstance()->getConnection();
    }

    // Getter methods

    public function getEvaluateID()
    {
        return $this->EvaluateID;
    }

    public function getAnswerID()
    {
        return $this->AnswerID;
    }

    public function getUserID()
    {
        return $this->UserID;
    }

    public function getCreatedDate()
    {
        return $this->CreatedDate;
    }

    public function getRateCategory()
    {
        return $this->RateCategory;
    }

    // Setter methods

    public function setEvaluateID($EvaluateID)
    {
        $this->EvaluateID = $EvaluateID;
    }

    public function setAnswerID($AnswerID)
    {
        $this->AnswerID = $AnswerID;
    }

    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }

    public function setCreatedDate($CreatedDate)
    {
        $this->CreatedDate = $CreatedDate;
    }

    public function setRateCategory($RateCategory)
    {
        $this->RateCategory = $RateCategory;
    }

    public function update()
    {
        $EvaluateID = $this->EvaluateID;
        $AnswerID = $this->AnswerID;
        $UserID = $this->UserID;
        $CreatedDate = $this->CreatedDate;
        $RateCategory = $this->RateCategory;

        $query = "UPDATE answer_evaluates SET AnswerID = '$AnswerID', UserID = '$UserID', CreatedDate = '$CreatedDate', RateCategory = '$RateCategory' WHERE EvaluateID = '$EvaluateID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Update successful
        } else {
            return 0; // Update failed
        }
    }
    public function getLast3Rate()
    {
        $query = "SELECT * FROM answer_evaluates ORDER BY CreatedDate DESC LIMIT 3";
        $result = mysqli_query($this->dbConnection, $query);

        $answerList = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $answerList[] = $row;
        }

        return $answerList;
    }

    public function create()
    {
        $AnswerID = $this->AnswerID;
        $UserID = $this->UserID;
        $CreatedDate = $this->CreatedDate;
        $RateCategory = $this->RateCategory;

        $query = "INSERT INTO answer_evaluates (AnswerID, UserID, CreatedDate, RateCategory) VALUES ('$AnswerID', '$UserID', '$CreatedDate', '$RateCategory')";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Create successful
        } else {
            return 0; // Create failed
        }
    }

    public function delete()
    {
        $EvaluateID = $this->EvaluateID;

        $query = "DELETE FROM answer_evaluates WHERE EvaluateID = '$EvaluateID'";
        $result = mysqli_query($this->dbConnection, $query);

        if ($result) {
            return 1; // Delete successful
        } else {
            return 0; // Delete failed
        }
    }
}

<?php

include_once '../commons/my_db_connection.php';
$dbConnectObj = new dbconnection();

class my_feedback_model{
    public function addFeedback($rate, $satisfaction, $prices, $timeliness, $support, $recommend, $suggestions)
        {
            $conn = $GLOBALS["con"];
            $sql = "INSERT INTO feedback(rate, satisfaction, prices, timeliness, support, recommend, suggestions)
                    VALUES('$rate', '$satisfaction', '$prices', '$timeliness', '$support', '$recommend', '$suggestions')";
            $result= $conn->query($sql);
            return $result;
        }
        public function getSuggestions() 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT suggestions FROM feedback";
        $result = $conn->query($sql);
        return $result;
        }
        public function getRate($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS RateCount FROM feedback WHERE rate = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
        public function getSatisfaction($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS SatisCount FROM feedback WHERE satisfaction = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
        public function getPrices($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS PriceCount FROM feedback WHERE prices = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
        public function getTimeliness($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS TimeCount FROM feedback WHERE timeliness = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
        public function getSupport($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS SupportCount FROM feedback WHERE support = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
        public function getRecommend($level) 
        {
        $conn = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS RecommendCount FROM feedback WHERE recommend = '$level'";
        $result = $conn->query($sql);
        return $result;
        }
}
?>


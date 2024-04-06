<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    class dbConnection {
        private $host;
        private $user;
        private $password;
        private $dbname;

        function connect() {
            $this->host = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->dbname = "techtalk_db";

            /*
            $dbServername = "sql309.epizy.com";
            $dbUsername = "epiz_30525628";
            $dbPassword = "MN70wFAfczfFlX";
            $dbName = "epiz_30525628_techtalk_db";
            */

            $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
            return $conn;
        }
    }

    class Rating extends dbConnection {
        function createRating($r_score, $r_review, $r_pid, $r_uid){
            $query = $this->connect();
            $stmt = $query->prepare("INSERT INTO rating (r_score, r_review, r_pid, r_uid) VALUES (?,?,?,?)");
            $stmt->bind_param("isii", $r_score, $r_review, $r_pid, $r_uid);
            $stmt->execute();
        }
    }
?>
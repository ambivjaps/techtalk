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

    class Registration extends dbConnection {
        function registerUser($u_lname, $u_fname, $u_user, $u_pwd, $u_bio, $u_email, $saveImage, $timestamp){
            $timestamp = date("Y-m-d H:i:s");
            $u_password = password_hash($u_pwd, PASSWORD_DEFAULT);

            $image = $_FILES['u_avatar']['name'];
            $temp_name = $_FILES['u_avatar']['tmp_name'];  
            if(isset($image) and !empty($image)){
                $location = './img/upload/';      
                if(move_uploaded_file($temp_name, $location.$image)){
                    echo '';
                }
                } else {
                    $image = 'img/person_black.png';
                }
            $query = $this->connect();
            $stmt = $query->prepare("INSERT INTO user (u_lname, u_fname, u_user, u_pwd, u_bio, u_email, u_avatar, created_at) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $u_lname, $u_fname, $u_user, $u_password, $u_bio, $u_email, $image, $timestamp);
            $stmt->execute();
        }
    }
?>
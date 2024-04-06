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

    class Profile extends dbConnection {
        function editProfile($u_id, $u_lname, $u_fname, $u_user, $u_pwd, $u_email, $u_bio, $saveImage){
            $u_id = $_POST['u_id'];
            $u_password = password_hash($u_pwd, PASSWORD_DEFAULT);

            $image = $_FILES['u_avatar']['name'];
            $saveImage = 'img/upload/' .$_FILES['u_avatar']['name'];  
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
            $stmt = $query->prepare("UPDATE user SET u_lname = ?, u_fname = ?, u_user = ?, u_pwd = ?, 
                                u_email = ?, u_bio = ?, u_avatar = ? WHERE u_id = ?");
            $stmt->bind_param("isssssss", $u_id, $u_lname, $u_fname, $u_user, $u_password, $u_email, $u_bio, $saveImage);
            $stmt->execute();
        }
    }
?>
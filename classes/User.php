<?php
class Users{
    public $id;
    public $username;
    public $email;
    public $password;
    public $phone;
    public $photo;
    public $full_name;
    public $city;
    public $country;
    public $code;
    public $conn;
    public $created_at;
    public $user_table;
    public function __construct($db){
        $this->conn = $db;
        $this->user_table = "logins";
        $this->created_at = date("Y-m-d h:i");
    }
    public function create_user(){
        $query = "INSERT INTO ".$this->user_table." (email,password,email_verified_status,created_at) VALUES ('$this->email','$this->password','false','$this->created_at')";

    $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function createProfile(){
        $query = "UPDATE ".$this->user_table." SET
        user_name = '$this->username',
        full_name = '$this->full_name',
        city = '$this->city',
        country = '$this->country',
        image ='$this->photo'
        WHERE email ='$this->email'";
    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function emailStatus(){
        $query = "UPDATE logins SET
        email_verified_status = 'true'
        WHERE email = '$this->email'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function updatePassword(){
        $query = "UPDATE logins SET
        password = '$this->password'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function resetPassword(){
        $query = "UPDATE logins SET
        password = '$this->password'
        WHERE email = '$this->email'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function code(){
        $query = "UPDATE logins SET
        email_code = '$this->code'
        WHERE email = '$this->email'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function updateProfile(){
        $query = "UPDATE ".$this->user_table." SET
        user_name = '$this->username',
        full_name = '$this->full_name'
        WHERE id ='$this->id'";
    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function updateProfilePicture(){
        $query = "UPDATE ".$this->user_table." SET
        image = '$this->photo'
        WHERE id ='$this->id'";
    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
// select all by id
    public function searchById(){
        $query = "SELECT * FROM ".$this->user_table." WHERE id = " . $this->id;
    $result = mysqli_query($this->conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row["id"])) {
            # code...
            $id=$row["id"];
        
            if (!empty($row["full_name"])) {
                $full_name = $row["full_name"];
            }else{
                $full_name = "";
            }
            if (!empty($row["image"])) {
                $image = $row["image"];
            }else{
                $image = "";
            }
            if (!empty($row["user_name"])) {
                $user_name = $row["user_name"];
            }else{
                $user_name = "";
            }
            if (!empty($row["password"])) {
                $password = $row["password"];
            }else{
                $password = "";
            }
            if (!empty($row["email"])) {
                $email = $row["email"];
            }else{
                $email = "";
            }
            if (!empty($row["location_address"])) {
                $location_address = $row["location_address"];
            }else{
                $location_address = "";
            }
            if (!empty($row["phone_no"])) {
                $phone_no = $row["phone_no"];
            }else{
                $phone_no = "";
            }
            if (!empty($row["email_verified_status"])) {
                $email_verified_status = $row["email_verified_status"];
            }else{
                $email_verified_status = "";
            }
            if (!empty($row["status"])) {
                $status = $row["status"];
            }else{
                $status = "";
            }
            if (!empty($row["created_at"])) {
                $created_at = $row["created_at"];
            }else{
                $created_at = "";
            }
            
            
            
            
            
            $query2 = "SELECT * FROM reviews WHERE reviewed_user_id='$id'";
            $result2 = mysqli_query($this->conn, $query2);
            $rows_count=mysqli_num_rows($result2);
            if($rows_count == 0){
                $avarage = 0;
            }else{
            $count = 0;
                while($row = mysqli_fetch_assoc($result2)){
                $count = $count + $row["review"];
                }
            $avarage = $count / $rows_count;
            }
            $query5 = "SELECT * FROM follow WHERE following_id=".$id;
            $result5 = mysqli_query($this->conn, $query5);
                $rows=mysqli_num_rows($result5);
            $query6 = "SELECT * FROM follow WHERE user_id=".$id;
            $result6 = mysqli_query($this->conn, $query6);
                $rows2=mysqli_num_rows($result6);
            
                    # code...
            $array = array(
                "id"=>$id,
                "full_name"=>$full_name,
                "image"=>$image,
                "user_name"=>$user_name,
                "password"=>$password,
                "email"=>$email,
                "location_address"=>$location_address,
                "phone_no"=>$phone_no,
                "email_verified_status"=>$email_verified_status,
                "status"=>$status,
                "review"=>$avarage,
                "followers"=>$rows,
                "following"=>$rows2,
                "created_at"=>$created_at,
            );
            return $array;
        }else{
            $id = '';
    }
    }

    return array();
    }

// select all by email
    public function searchByEmail(){
        $query = "SELECT * FROM logins WHERE email='$this->email'";
    $result = mysqli_query($this->conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row["id"])) {
            # code...
            $id=$row["id"];
        
            if (!empty($row["full_name"])) {
                $full_name = $row["full_name"];
            }else{
                $full_name = "";
            }
            if (!empty($row["image"])) {
                $image = $row["image"];
            }else{
                $image = "";
            }
            if (!empty($row["user_name"])) {
                $user_name = $row["user_name"];
            }else{
                $user_name = "";
            }
            if (!empty($row["password"])) {
                $password = $row["password"];
            }else{
                $password = "";
            }
            if (!empty($row["email"])) {
                $email = $row["email"];
            }else{
                $email = "";
            }
            if (!empty($row["location_address"])) {
                $location_address = $row["location_address"];
            }else{
                $location_address = "";
            }
            if (!empty($row["phone_no"])) {
                $phone_no = $row["phone_no"];
            }else{
                $phone_no = "";
            }
            if (!empty($row["email_verified_status"])) {
                $email_verified_status = $row["email_verified_status"];
            }else{
                $email_verified_status = "";
            }
            if (!empty($row["status"])) {
                $status = $row["status"];
            }else{
                $status = "";
            }
            if (!empty($row["city"])) {
                $city = $row["city"];
            }else{
                $city = "";
            }
            if (!empty($row["country"])) {
                $country = $row["country"];
            }else{
                $country = "";
            }
            if (!empty($row["created_at"])) {
                $created_at = $row["created_at"];
            }else{
                $created_at = "";
            }
            $query2 = "SELECT * FROM reviews WHERE reviewed_user_id='$id'";
            $result2 = mysqli_query($this->conn, $query2);
            $rows_count=mysqli_num_rows($result2);
            if($rows_count == 0){
                $avarage = 0;
            }else{
            $count = 0;
                while($row = mysqli_fetch_assoc($result2)){
                $count = $count + $row["review"];
                }
            $avarage = $count / $rows_count;
            }
            $query5 = "SELECT * FROM follow WHERE following_id=".$id;
            $result5 = mysqli_query($this->conn, $query5);
                $rows=mysqli_num_rows($result5);
            $query6 = "SELECT * FROM follow WHERE user_id=".$id;
            $result6 = mysqli_query($this->conn, $query6);
                $rows2=mysqli_num_rows($result6);
            
                    # code...
            $array = array(
                "id"=>$id,
                "full_name"=>$full_name,
                "image"=>$image,
                "user_name"=>$user_name,
                "password"=>$password,
                "email"=>$email,
                "location_address"=>$location_address,
                "city"=>$city,
                "country"=>$country,
                "phone_no"=>$phone_no,
                "email_verified_status"=>$email_verified_status,
                "status"=>$status,
                "review"=>$avarage,
                "followers"=>$rows,
                "following"=>$rows2,
                "created_at"=>$created_at,
            );
            return $array;
        }else{
            $id = '';
    }
    }
    return array();
    }
    public function searchByEmail2(){
        $query = "SELECT * FROM logins WHERE email='$this->email'";
    $result = mysqli_query($this->conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row["id"])) {
            # code...
            $id=$row["id"];
        
            if (!empty($row["full_name"])) {
                $full_name = $row["full_name"];
            }else{
                $full_name = "";
            }
            if (!empty($row["image"])) {
                $image = $row["image"];
            }else{
                $image = "";
            }
            if (!empty($row["user_name"])) {
                $user_name = $row["user_name"];
            }else{
                $user_name = "";
            }
            if (!empty($row["password"])) {
                $password = $row["password"];
            }else{
                $password = "";
            }
            if (!empty($row["email"])) {
                $email = $row["email"];
            }else{
                $email = "";
            }
            if (!empty($row["location_address"])) {
                $location_address = $row["location_address"];
            }else{
                $location_address = "";
            }
            if (!empty($row["phone_no"])) {
                $phone_no = $row["phone_no"];
            }else{
                $phone_no = "";
            }
            if (!empty($row["email_verified_status"])) {
                $email_verified_status = $row["email_verified_status"];
            }else{
                $email_verified_status = "";
            }
            if (!empty($row["status"])) {
                $status = $row["status"];
            }else{
                $status = "";
            }
            if (!empty($row["email_code"])) {
                $email_code = $row["email_code"];
            }else{
                $email_code = "";
            }
            if (!empty($row["created_at"])) {
                $created_at = $row["created_at"];
            }else{
                $created_at = "";
            }
            $query2 = "SELECT * FROM reviews WHERE reviewed_user_id='$id'";
            $result2 = mysqli_query($this->conn, $query2);
            $rows_count=mysqli_num_rows($result2);
            if($rows_count == 0){
                $avarage = 0;
            }else{
            $count = 0;
                while($row = mysqli_fetch_assoc($result2)){
                $count = $count + $row["review"];
                }
            $avarage = $count / $rows_count;
            }
            $query5 = "SELECT * FROM follow WHERE following_id=".$id;
            $result5 = mysqli_query($this->conn, $query5);
                $rows=mysqli_num_rows($result5);
            $query6 = "SELECT * FROM follow WHERE user_id=".$id;
            $result6 = mysqli_query($this->conn, $query6);
                $rows2=mysqli_num_rows($result6);
            
                    # code...
            $array = array(
                "id"=>$id,
                "full_name"=>$full_name,
                "image"=>$image,
                "user_name"=>$user_name,
                "password"=>$password,
                "email"=>$email,
                "location_address"=>$location_address,
                "phone_no"=>$phone_no,
                "email_verified_status"=>$email_verified_status,
                "status"=>$status,
                "review"=>$avarage,
                "followers"=>$rows,
                "following"=>$rows2,
                "created_at"=>$created_at,
                "email_code"=>$email_code,
            );
            return $array;
        }else{
            $id = '';
    }
    }
    return array();
    }
    public function getUserCode(){
        $query = "SELECT * FROM logins WHERE email='$this->email'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $r = mysqli_fetch_assoc($result);
            return $r;
    }
    }
    public function totalUsers(){
        $query = "SELECT * FROM logins";
    $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }
    public function selectAllUsers(){
        $query = "SELECT * FROM logins";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
    }
}
public function deleteUser(){
    $query = "DELETE FROM ".$this->user_table." WHERE id =" . $this->id;
    $upload = mysqli_query($this->conn, $query);
    $query2 = "DELETE FROM listing WHERE user_id = " . $this->id;
    $upload2= mysqli_query($this->conn, $query2);
    $query3 = "DELETE FROM reviews WHERE user_id = " . $this->id." OR reviewed_user_id =".$this->id;
    $upload3= mysqli_query($this->conn, $query3);
    $query4 = "DELETE FROM follow WHERE user_id = " . $this->id." OR following_id =".$this->id;
    $upload4= mysqli_query($this->conn, $query4);
    $query5 = "DELETE FROM chat_community WHERE user_id = " . $this->id." OR chat_with =".$this->id;
    $upload5= mysqli_query($this->conn, $query5);
    $query6 = "DELETE FROM comments WHERE user_id = " . $this->id;
    $upload6= mysqli_query($this->conn, $query6);
    if($upload && $upload2 && $upload3 && $upload5 && $upload5){
        return true;
    }
    return false;
}
public function selectTermsAndCondition(){
    $rows = array();
        # code...
        $query2 = "SELECT terms_and_conditions FROM admin LIMIT 1";
        $result2 = mysqli_query($this->conn, $query2);
        if ($result2) {
            while ($r2 = mysqli_fetch_assoc($result2)) {
            $rows[] = $r2;
    }
    return $rows;
}

return array();
}
public function selectPrivacyPolicy(){
    $rows = array();
        # code...
        $query2 = "SELECT privacy_policy FROM admin LIMIT 1";
        $result2 = mysqli_query($this->conn, $query2);
        if ($result2) {
            while ($r2 = mysqli_fetch_assoc($result2)) {
            $rows[] = $r2;
    }
    return $rows;
}

return array();
}
}
?>
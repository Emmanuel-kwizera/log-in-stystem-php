<?php
include_once "DBConnect.php";
class LoginSystem extends DBConnect{
    
    private $user_table = "RCA0125_users";
    
    public function registerUser($familyname,$firstname,$email, $password, $reg_date){
        $familyname = self::filterUserInput($familyname);
        $firstname = self::filterUserInput($firstname);
        $email = self::filterUserInput($email);
        $password = md5(self::filterUserInput($password));
        if($this->checkUserExistence($email)=="OkayToGo!"){
            $sql = "
            INSERT INTO ".$this->user_table." SET 
            familyname=:familyname,
            firstname=:firstname,
            email=:email,
            password=:password,
            level=:levels,
            registration_date=:registration_date
            ";
            
            $q = parent::__construct()->prepare($sql);
            $q->bindValue(":familyname", $familyname); 
            $q->bindValue(":firstname", $firstname); 
            $q->bindValue(":email", $email); 
            $q->bindValue(":password", $password);
            $q->bindValue(":levels",0, PDO::PARAM_INT);
            $q->bindValue(":registration_date", $reg_date);
            if($q->execute()){
                echo "User registered.";
            }else{
                echo "User Not registered";
            }
        
        }
        elseif($this->checkUserExistence($email)=="OopsUserExists!"){
            echo "The user with same email is already registered!";
        }        
    }
    
    public function loginUser($email, $password){
        $email = self::filterUserInput($email);
        $password = md5(self::filterUserInput($password));
        $sql = "SELECT familyname, firstname,level FROM ".$this->user_table." WHERE  
        email=:email AND password=:password AND level != 0";
        $q = parent::__construct()->prepare($sql);
        $q->bindValue(":email", $email); 
        $q->bindValue(":password", $password);
        $q->execute();
    
        if($q->rowCount()==1){
            
            $row = $q->fetch();
            $_SESSION["FAMILYNAME"] = $row["familyname"];
            $_SESSION["FIRSTNAME"] = $row["firstname"];
            $_SESSION["EMAIL"] = $email;
            $_SESSION["LEVELS"] = $row['level'];
            echo "UserLoggedInSuccessfully!";
            
        }
        else{
        echo "UserLoginFailed!"; 
        }
    } 
    
    private function checkUserExistence($email){
        $sql="SELECT email FROM ".$this->user_table." WHERE email=:email"; 
        $q = parent::__construct()->prepare($sql);
        $q -> bindValue(":email", $email);
        $q -> execute();
        if($q->rowCount()==0){
            return "OkayToGo!";
        }else{
            return "OopsUserExists!";
        }
    }
    
    private static function filterUserInput($input){
        return trim($input);
    }
    public function readData(){
        $sql = "SELECT  id,CONCAT(familyname,' ',firstname ) as username,level,email ,registration_date FROM `".$this->user_table."`";
        $q = parent::__construct()->prepare($sql);
        $q->execute();
        echo "<hr>";
        $i=1;
        echo "
        <div class = 'text-center' id = 'status'></div>
        <div class = 'container'>
        <table class = 'table table-bordered table-striped table-hover'>
        <thead class = 'thead-dark'>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Registration Date</th>
                <th>Action</th>
            </tr>
        </thead>
        ";
        foreach($q as $row):
            $text = "";
            if($row["level"] == 1)
                $text = "User";
            elseif($row["level"] == 2)
                $text = "Admin";
            else
                $text = "Not Mentioned";
            echo "
                <tr>
                    <td> ".$i."</td>
                    <td> ".$row["username"]." </td>
                    <td> ".$row["email"]." </td>
                    <td> ".$text." </td>
                    <td> ".$row["registration_date"]." </td>
                    <td> <button class = 'btn btn-primary' data-id = ".$row['id']." onclick = 'UpdateNow(this,\"status\")'>Change</button> </td>
                </tr>
            ";
            $i++;
        endforeach;    
        echo "
            <tfoot>
                <tr>
                    <td colspan = '6'>
                        <p class = 'text-center'>Hello ".$_SESSION["FIRSTNAME"]." You are at Super Admin dashboard !!!</p>
                    </td>
                </tr>
            <tfoot>
        </table>
        </div>
        ";
    }
    public function updateAdmin($id,$newData){
        $id = self::filterUserInput($id);
        $newData = self::filterUserInput($newData);
        $sql = "UPDATE ".$this->user_table." SET level=:level WHERE `id`=:id";
        $q = parent::__construct()->prepare($sql);
        $q->bindValue(":level",$newData, PDO::PARAM_INT); 
        $q->bindValue(":id", $id, PDO::PARAM_INT);
        if($q->execute()){
            $this->readData();
        }else{
            echo "Data not updated ...........";
        }
    }
}
?>
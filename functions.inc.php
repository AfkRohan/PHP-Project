<?php
    require_once("./db/db_conn.php");
    session_start();
    
    function login($email, $password)
    {
        global $pdo;
        $stmt=$pdo->prepare(
            "select CID, Password_hash from customer
            where Email=:email");
        $stmt->execute([
            "email" => $email
        ]);
        //12
        if($stmt->rowCount()==1)
        {
            
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            if($password == $row["Password_hash"])
            {
                session_regenerate_id();
                $_SESSION["CID"]=$row["CID"];
                return true;
            }
        }
        return false;
    }
    
    function logout()
    {
        $_SESSION=[];
        session_destroy();
        setcookie("PHPSESSID",'',time()-3600,"/",'',0,0);
    }

    function redirectIfLoggedIn()
    {
        if(!empty($_SESSION["CID"]))
        {
            header("Location: index.php");
        }
    }
    
    function redirectIfNotLoggedIn()
    {
        if(empty($_SESSION["CID"]))
        {
            header("Location: login.php");
        }
    }



<?php
    require("db.php");

    $email = $_POST['email'];
    $password = $_POST['password']; 

    if(trim($email) == "" || trim($password) == ""){
        msgAndBack("필수값이 비어있습니다.");
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = ? AND password = PASSWORD(?)";

    $user = fetch($con, $sql, [$email, $password]);

    if(!$user){
        msgAndBack("아이디나 비밀번호가 잘못되었습니다.");
        exit;
    }

    $_SESSION['user'] = $user;
    if(isset($_SESSION['nextPage'])){
        msgAndGo("로그인 되었습니다.", $_SESSION['nextPage']);
        unset($_SESSION['nextPage']);
    }else{
        msgAndGo("로그인 되었습니다.", "/");
    }
<?php
require("db.php");

$email = htmlentities($_POST['email']);
$nick = htmlentities($_POST['nick']);
$password = htmlentities($_POST['password']);
$password2 = htmlentities($_POST['password2']);

if(trim($email) == "" || trim($nick) == "" || trim($password) == ""){
    msgAndBack("필수 값이 누락되었습니다.");
    exit;
}

if($password != $password2) {
    msgAndBack("비밀번호와 비밀번호 확인이 다릅니다.");
    exit;
}
$sql = "INSERT INTO users(`email`, `nickname`, `password`, `level`)
         VALUES (?, ?, PASSWORD(?), 1)";
$cnt = query($con, $sql, [$email, $nick, $password]);

if($cnt == 1){
    msgAndGo("회원가입하였습니다. 즐거운시간 되세요.","/");
    exit;
}else{
    msgAndBack("회원가입에 실패하였습니다.");
    exit;
}
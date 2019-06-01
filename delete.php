<?php
require ("db.php");

//로그인한지도 체크
if(!isset($_SESSION['user'])){
    msgAndGo("로그인하지 않았습니다.", "/login.php");
    exit;
}
$user = $_SESSION['user'];

$id = $_GET['id'];

$sql = "SELECT * FROM boards WHERE id = ?";
$data = fetch($con, $sql, [$id]);

if(!$data){
    msgAndBack("해당하는 글이 존재하지 않습니다.");
    exit;
}
//해당 글이 지금 현재 로그인한 사용자의 글인지 체크
if($data->writer != $user->nickname && $user->nickname != trim("관리자")) {
    msgAndBack("권한이 없습니다.");
    exit;
}

$sql = "DELETE FROM boards WHERE id = ?";
$cnt = query($con, $sql, [$id]);

if($cnt == 1){
    msgAndGo("삭제되었습니다.", "/list.php");
}else{
    msgAndBack("삭제중 오류 발생");
}
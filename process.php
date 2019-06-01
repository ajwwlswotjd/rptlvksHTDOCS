<?php
require ("db.php");

$file = null;

if(isset($_FILES['upload']['name']) ){
    $file = $_FILES['upload'];
}

if($file != null){
    if(strncmp("image/", $file['type'], 6) != 0){
        msgAndBack("이미지 파일만 업로드할 수 있습니다.");
        exit;
    }
}


if(!isset($_SESSION['user'])){
    msgAndGo("로그인한 유저만 글을 쓸 수 있습니다.", "/login.php");
    exit;
}


$title = $_POST['title'];
$writer = $_POST['writer'];
$content = $_POST['content'];

if(trim($title) == "" || trim($writer) == "" || trim($content) == ""){
    msgAndBack("필수 값이 대충 비어있습니다.");
    exit;
}

$id = $_POST['id'];
$params = [$title, $writer, $content];

if($id == 0){
    $sql = "INSERT INTO boards 
    (`title`, `writer`, `content`, `wdate`";
    
    //$sql .= $file != null ? ", img)" : ")";
    
    if($file != null){
        $sql .= ", img) VALUES (?, ?, ?, NOW(), ?)";
        move_uploaded_file($file['tmp_name'], "upload/" . $file['name']);
        $params[] = "./upload/".$file['name'];
    }else {
        $sql .= ") VALUES (?, ?, ?, NOW())";
    }
    
}else {
    //수정일 경우에는 해당 글에 수정 권한이 있는지 체크해야 한다.
    $sql = "SELECT * FROM boards WHERE id = ?";

    $result = fetch($con, $sql, [$id]);
    if($result->writer != $_SESSION['user']->nickname){
        msgAndBack("권한이 대충 없습니다.");
        exit;
    }

    if($file != null){
        $sql = "UPDATE boards SET `title` = ? , `writer` = ?, `content` = ? , `img` = ? WHERE id = ?";
        move_uploaded_file($file['tmp_name'], "upload/" . $file['name']);
        $params[] = "./upload/".$file['name'];
        $params[] = $id;
    }else {
        $sql = "UPDATE boards SET `title` = ? ,
        `writer` = ?, `content` = ?
        WHERE id = ?";
        $params[] = $id;
    }

}

$cnt = query($con, $sql, $params);

if($cnt == 1){
    if($id == 0){
        msgAndGo("글 작성이 대충 완료되었습니다.", "/list.php");
    }else { 
        msgAndGo("글 수정이 대충 완료되었습니다.", "/list.php");
    }   
}else{
    msgAndBack("오류가 대충 발생했습니다");
}
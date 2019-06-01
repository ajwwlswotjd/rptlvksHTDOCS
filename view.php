<?php
require("db.php");

$sql = "SELECT * FROM boards WHERE id = ?";

$q = $con->prepare($sql);

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    echo "잘못된 접근입니다.";
    exit;
}

$q->execute([$id]);
$data = $q->fetch(PDO::FETCH_OBJ);

if(!$data){
    echo "존재하지 않는 글입니다.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="ko">

<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>
    <div id="view_popup">
        <?php if($data->img != "") :?>
            <img src="<?= $data->img ?>" alt="img">
        <?php endif; ?>
        <div class="btn-container">
            <a href="<?= $data->img ?>" class="btn btn-dark" download>다운로드</a>
            <button id="view_popup_close" class="btn btn-danger">닫기</button>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <div id="view_id" class="col-12 d-flex justify-content-center"><?= $data->id; ?></div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="view_id_bar" class="col-1 bg-info">&nbsp;</div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="view_writer" class="col-12 d-flex justify-content-center">
                작성자 : <?= htmlentities($data->writer) ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="view_title" class="col-12 d-flex justify-content-center"><?= htmlentities($data->title) ?></div>
        </div>

        <div class="row">
            <div id="view_wdate" class="col-12"> 작성날짜 : <?= htmlentities($data->wdate) ?></div>
        </div>

        
        <div class="row d-flex justify-content-center">
            <div id="view_content" class="col-12">
                <?= nl2br(htmlentities($data->content)) ?>
            </div>
        </div>

        <div class="row">
            <div id="view_img" class="col-12 d-flex justify-content-center mt-3 <?= $data->img != '' ? 'view_img_able' : null ?>">
                <?php if($data->img != "") : ?>
                    <span id="view_img_btn">이미지 보기 (클릭)</span>
                    <?php else : ?>
                        <span id="view_img_btn">이미지 없음</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row" style="float: right;">
                <div class="col-12 mt-3">

                    <?php if(isset($_SESSION['user'])): ?>
                        <?php if($data->writer == $_SESSION['user']->nickname || $_SESSION['user']->nickname == "관리자") : ?>
                            <a href="/form.php?id=<?= $data->id ?>" class=" btn btn-info">글 수정</a>
                            <a href="/delete.php?id=<?= $data->id?>" class="btn btn-danger">글 삭제</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <a href="/list.php" class="btn btn-primary">게시판</a>
                </div>
            </div>
        </div>
        <script>
            document.querySelector("#view_popup_close").addEventListener("click",()=>{
                document.querySelector("#view_popup").style.display = "none";
            });

            document.querySelector(".view_img_able").addEventListener("click", ()=>{
                document.querySelector("#view_popup").style.display = "block";
            });
        </script>
    </body>
    </html>
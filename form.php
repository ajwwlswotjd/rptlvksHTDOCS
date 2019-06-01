<?php
require ("db.php");

if(!isset($_SESSION['user'])){
    $_SESSION['nextPage'] = "form.php";
    msgAndGo("글을 쓰기 위해서는 로그인을 해야합니다.", "/login.php");
    exit;
}

    $mod = 0; // 글 작성모드
    if(isset($_GET['id'])){
        //글 수정 모드
        $mod = $_GET['id'];
        $sql = "SELECT * FROM boards WHERE id = ?";
        $q = $con->prepare($sql);
        $q->execute([ $_GET['id'] ]);
        $data = $q->fetch(PDO::FETCH_OBJ);

        if(!$data){
            echo "대충 존재하지 않는 글입니다.";
            exit;
        }

        if($_SESSION['user']->nickname == $data->writer || $_SESSION['user']->nickname == "관리자"){
            echo "<script>alert('대충 한번 변경한 글은 재수정할수 있으나 되돌릴수 없으므로 신중하게 대충 작성해주시길 바랍니다.');</script>";
        }else {
            msgAndBack("권한이 대충 없습니다.");
            exit;
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ko">
    <?php require("head.php"); ?>

    <body>
        <?php require './nav.php'; ?>
        <?php if($mod == 0) : ?>
            <h1 id="form_h1">글 작성</h1>
            <?php else : ?>
                <h1 id="form_h1">글 수정</h1>
            <?php endif; ?>
            <div class="container">
             <form action="/process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $mod ?>">
                <input type="hidden" name="writer" value="<?= $_SESSION['user']->nickname ?>">
                <div class="form-group">
                    <input class="form-control mt-3 form_input" type="text" placeholder="제목" name="title" id="form_title" value="<?= $mod != 0 ? $data->title : "" ?>">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="form_textarea" cols="30" rows="15" placeholder="글 내용"><?= $mod != 0 ? "$data->content" : null ?></textarea>
                </div>
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">이미지 업로드</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="upload" class="custom-file-input" id="form_file">
                    <label class="custom-file-label" for="form_file" id="file_name">
                        <?php if($mod == 0 || $data->img == "") : ?>
                            이미지파일 미업로드
                            <?php else : ?>
                                <?= $data->img ?>
                        <?php endif; ?>
                    </label>
                </div>
            </div>

            <div style="float: right;" class="form-group">
                <span id="form_reset" style="cursor: pointer; font-weight: bolder; letter-spacing: 2px;" class="btn btn-info btn-lg">재설정</span>
                <button type="submit" style="font-weight: bolder; letter-spacing: 2px;" class="btn btn-primary btn-lg">완료</button>
            </div>
        </form>
    </div> 
    <script>
        document.querySelector("#form_reset").addEventListener("click",()=>{
            document.querySelectorAll(".form_input").forEach((input)=>{input.value = "";});
            document.querySelector("#form_textarea").innerHTML = null;
        });

        document.querySelector("#form_file").addEventListener("change",function(){
            let fileName = this.files[0].name;
            document.querySelector("#file_name").innerHTML = fileName;
            console.log(this.value);
        });
    </script>
</body>
</html>
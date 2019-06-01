<!DOCTYPE html>
<html lang="ko">

<?php require("head.php"); ?>

<body>
    <?php require("nav.php"); ?>

    <div class="container">
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>로그인</h4>
                    </div>
                    <div class="card-body">
                        <form action="/login_ok.php" method="post">
                            <div class="form-group">
                                <label for="email">이메일</label>
                                <input class="form-control" type="text" id="email" 
                                    name="email" placeholder="이메일 입력">
                            </div>

                            <div class="form-group">
                                <label for="password">비밀번호</label>
                                <input class="form-control" type="password" id="password"
                                     name="password" placeholder="비밀번호 입력">
                            </div>

                            <button type="submit" class="btn btn-outline-success">완료</button>
                            <a href="/register.php" class="btn btn-outline-primary">회원가입</a>
                            <a href="/idFind.php" class="btn btn-outline-info">아이디/비밀번호 찾기</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
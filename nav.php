<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">대충 있어보이는 사이트</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/list.php">게시판</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/form.php">글쓰기</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <?php if(isset($_SESSION['user'])) : ?>
                <li class="nav-item">
                    <a href="#" class="nav-link"><?= $_SESSION['user']->nickname ?>님</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">로그아웃</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">회원가입</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php">로그인</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
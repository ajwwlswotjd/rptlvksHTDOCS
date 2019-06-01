<!DOCTYPE html>
<html lang="ko">
<?php require './head.php'; ?>
<body>
	<?php require './nav.php'; ?>
	<div class="container">
		<form action="/id_find.php" method="POST">
			<div class="form-group mt-5">
				<label style="font-weight: bolder; font-size: 35px;" for="idFind_email">아이디 찾기</label>
				<input type="text" class="form-control" id="idFind_email" placeholder="가입시 입력한 닉네임 입력">
				<small id="emailHelp" class="form-text text-muted">아니 근데 이렇게하면 누구나 다 털수있는거아니냐?</small>
				<button type="submit" class="btn btn-primary mt-1">아이디 찾기</button>
			</div>
		</form>

		<form action="/passwordChange.php" method="POST">
			<div class="form-group mt-5">
				<label style="font-weight: bolder; font-size: 35px;" for="idFind_email">비밀번호 변경</label>
				<input type="text" class="form-control" id="idFind_email" placeholder="이메일">
				<small id="emailHelp" class="form-text text-muted">아니 근데 이렇게하면 누구나 다 털수있는거아니냐?</small>
				<button type="submit" class="btn btn-primary mt-1">비밀번호 변경</button>
			</div>
		</form>
	</div>
</body>
</html>
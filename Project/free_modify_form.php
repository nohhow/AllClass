<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>모두의 클래스</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<script>
		function check_input() {
			if (!document.board_form.subject.value) {
				alert("제목을 입력하세요!");
				document.board_form.subject.focus();
				return;
			}
			if (!document.board_form.content.value) {
				alert("내용을 입력하세요!");
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
		}
	</script>
</head>

<body>
	<section>
		<div id="board_box">
			<h3 id="board_title">
				게시판 > 글 쓰기
			</h3>
			<?php
			$num  = $_GET["num"];

			$con = mysqli_connect("localhost", "user1", "12345", "all_class");
			$sql = "select * from free_board_class where num=$num";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result);
			$name       = $row["name"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$file_name  = $row["file_name"];
			$old_name   = $row["file_copied"];
			?>
			<form name="board_form" method="post" action="free_modify.php?num=<?= $num ?>" enctype="multipart/form-data">
				<ul id="board_form">
					<li>
						<span class="col1">이름 : </span>
						<span class="col2"><?= $name ?></span>
					</li>
					<li>
						<span class="col1">제목 : </span>
						<span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
					</li>
					<li id="text_area">
						<span class="col1">내용 : </span>
						<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
					</li>
					<li>
						<span class="col1"> 첨부 파일 : </span>
						<span class="col2"><input type="file" name="upfile"/></span>
						<input type="hidden" name= "oldfile" value="<?=$old_name?>"/>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" onclick="check_input()">수정하기</button></li>
					<li><button type="button" onclick="self.close()">취소하기</button></li>
				</ul>
			</form>
		</div> <!-- board_box -->
	</section>
</body>

</html>
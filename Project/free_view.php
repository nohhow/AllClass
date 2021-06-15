<?php //session_start();
if (isset($_GET['class_name']) && !empty($_GET['class_name']) and isset($_GET['class_info']) && !empty($_GET['class_info'])) {
	$class_name = $_GET['class_name'];
	$class_info = $_GET['class_info'];
	$class_code = $_GET['class_code'];
	$where = $_GET['w'];
?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>모두의 클래스</title>
		<link href="css/styles.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="./css/common.css">
		<link rel="stylesheet" type="text/css" href="./css/details.css">
		<link rel="stylesheet" type="text/css" href="./css/board.css">
	</head>

	<body class="sb-nav-fixed">
		<header>
			<?php include "class_detail_header.php"; ?>
		</header>
		<section>
			<div id="layoutSidenav">
				<div id="layoutSidenav_nav">
					<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
						<div class="sb-sidenav-menu">
							<div class="nav">
								<div class="sb-sidenav-menu-heading">공지사항</div>
								<a class="nav-link" href="class_detail.php?w=notice&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
									<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
									공지사항
								</a>
								<div class="sb-sidenav-menu-heading">게시판</div>
								<a class="nav-link collapsed" href="class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
									<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
									자유게시판
								</a>
								<a class="nav-link collapsed" href="class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
									<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
									질문게시판
								</a>
								<a class="nav-link collapsed" href="class_detail.php?w=assg&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
									<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
									과제게시판
								</a>
							</div>
						</div>
						<div class="sb-sidenav-footer">
							<div class="small">모두의 클래스</div>
						</div>
					</nav>
				</div>
				<div id="layoutSidenav_content">
					<div id="board_box">
						<h3 class="title">
							게시판 > 내용보기
						</h3>
						<?php
						$num  = $_GET["num"];
						//$page  = $_GET["page"];

						$con = mysqli_connect("localhost", "user1", "12345", "all_class");
						$sql = "select * from free_board_class where num=$num";
						$result = mysqli_query($con, $sql);

						$row = mysqli_fetch_array($result);
						$id      = $row["id"];
						$name      = $row["name"];
						$regist_day = $row["regist_day"];
						$subject    = $row["subject"];
						$content    = $row["content"];
						$file_name    = $row["file_name"];
						$file_type    = $row["file_type"];
						$file_copied  = $row["file_copied"];
						$hit          = $row["hit"];

						$content = str_replace(" ", "&nbsp;", $content);
						$content = str_replace("\n", "<br>", $content);

						$new_hit = $hit + 1;
						$sql = "update free_board_class set hit=$new_hit where num=$num";
						mysqli_query($con, $sql);
						?>
						<ul id="view_content">
							<li>
								<span class="col1"><b>제목 :</b> <?= $subject ?></span>
								<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
							</li>
							<li>
								<?php
								if ($file_name) {
									$real_name = $file_copied;
									$file_path = "./data/" . $real_name;
									$file_size = filesize($file_path);

									echo "<img style='width: 100%;'" . " src='$file_path'/><br><br>";
								}
								?>
								<?= $content ?>
							</li>
						</ul>

						<ul class="buttons">
							<li><button onclick="location.href='class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">목록</button></li>
							<?php if ($username == $name) { ?>
								<li><button onclick="modify()">수정</button></li>
								<li><button onclick="location.href='free_delete.php?num=<?= $num ?>&w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">삭제</button></li>
							<?php } ?>
						</ul>
						<form name="free_comment" method="post" action="free_comment_insert.php?num=<?= $num ?>&class_code=<?= $class_code ?>">
							<div style="height:50px">
								<textarea name="content" style="float: left; width:80%; height:100%" placeholder="댓글을 입력하세요."></textarea>
								<button type="button" style="float: right; width:20%; height:100%;" onclick="check_input()">입력</button>
							</div>
						</form>
						<div>
							<?php
							$con = mysqli_connect("localhost", "user1", "12345", "all_class");
							$sql = "select com_num, id, content, regist_day  from free_comment where class_code='$class_code' and num=$num";
							$result = mysqli_query($con, $sql);
							$total_record = mysqli_num_rows($result);

							for ($i = 0; $i < $total_record; $i++) {
								mysqli_data_seek($result, $i);
								// 가져올 레코드로 위치(포인터) 이동
								$row = mysqli_fetch_array($result);
								// 하나의 레코드 가져오기
								$com_id          = $row["id"];
								$com_num     = $row["com_num"];
								$content     = $row["content"];
								$regist_day  = $row["regist_day"];
							?>
								<li>
									<span class="col3"><?= $com_id ?></span>
									<span class="col4"><?= $content ?></span>
									<span class="col5"><?= $regist_day ?></span>
									<span class="col6"><?= $com_num ?></span>
								</li>
							<?php
							}
							mysqli_close($con);
							?>
						</div>
					</div> <!-- board_box -->
				</div>
			</div>
		</section>
		<footer class="py-4 bg-light mt-auto">
			<?php include "footer.php"; ?>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="js/scripts.js"></script>
		<script>
			var where = '<?php echo $where; ?>';
			var num = '<?php echo $num; ?>';

			function modify() {
				var class_code = '<?php echo $class_code; ?>';


				window.open("free_modify_form.php?num=" + num,
					"NOTICEregist",
					"left=700,top=100,width=882,height=800,scrollbars=no,resizable=yes");
			}

			function check_input() {
				if (!document.free_comment.content.value) {
					alert("댓글을 입력하세요!");
					document.free_comment.content.focus();
					return;
				}

				document.free_comment.submit();
			}
		</script>
	</body>

	</html>

<?php
} else {
	echo "<h1>잘못된 접근 방식입니다.</h1>";
}

?>
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
		<link href="css/styles.css?after" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="./css/common.css?after">
		<link rel="stylesheet" type="text/css" href="./css/details.css?after">
		<link rel="stylesheet" type="text/css" href="./css/board.css?after">
	</head>

	<body class="sb-nav-fixed">
		<header>
			<?php include "class_detail_header.php"; ?>
		</header>
		<section>
		<div id="layoutSidenav">
				<div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-light" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">공지사항</div>
                                <a class="nav-link" href="class_detail.php?w=notice&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                    공지사항
                                </a>
                                <div class="sb-sidenav-menu-heading">게시판</div>
                                <a class="nav-link collapsed" href="class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    자유게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-question"  style="width:14.39px"></i></div>
                                    질문게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=assg&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-marker"></i></div>
                                    과제게시판
                                </a>
                                <div class="sb-sidenav-menu-heading">사용자</div>
                                <a class="nav-link" href="class_detail.php?w=users&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    사용자 명단
                                </a>
                                <a class="nav-link" href="class_detail.php?w=mail&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                    메일 보내기
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
				<div id="layoutSidenav_content" style = "margin-bottom : 5%">
					<div id="board_box">
						<h3 class="title">
							게시판 > 내용보기
						</h3>
						<?php
						$num  = $_GET["num"];

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
						<ul style="padding-left:0;" id="view_content">
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
								if (strpos($file_type, "image/")!==false) {
									if(strpos($file_type, "svg") !== false){
										echo "$file_name<br>";
									}else echo "<img style='width: 100%' src='$file_path'/><br><br>";
								} else {
									echo "<div class = 'text-body' style = 'font-size : 10px'>첨부파일 : $file_name </div><br>";
								}
								
								}
								?>
								<?= $content ?>
							</li>
						</ul>

					<ul class="buttons">
						<li><button onclick="location.href='class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">목록</button></li>
						<li><button onclick="location.href='board_download.php?&real_name=<?php echo $real_name; ?>&file_name=<?php echo $file_name; ?>&file_type=<?php echo $file_type; ?>'">파일 저장</button></li>
						<?php if ($username == $name) { ?>
							<li><button onclick="modify()">수정</button></li>
							<li><button onclick="location.href='free_delete.php?num=<?= $num ?>&w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">삭제</button></li>
						<?php } ?>
					</ul>
						<form name="free_comment" method="post" action="free_comment_insert.php?num=<?= $num ?>&class_code=<?= $class_code ?>">
							<div style="height:50px">
								<textarea id="comment_textarea" name="content" style="padding: 10px; float: left; width:80%; height:100%" placeholder="댓글을 입력하세요."></textarea>
								<button type="button" style="float: right; width:20%; height:100%;" onclick="check_input()">댓글 입력</button>
							</div>
						</form>

						<!--comment-->
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


							<div>
								<div>
									<span style="font-weight: bold; width: <?php echo (mb_strlen($com_id, 'utf-8')) * 5; ?>px"> <?= $com_id ?></span>
									<span style="width: <?php echo (mb_strlen($regist_day, 'utf-8')) * 5; ?>px; font-size:10px"> | <?= $regist_day ?></span>
								</div>
								<div>
									<span><?= $content ?></span>
								</div>

							</div>
							<form name="free_reply<?php echo $com_num; ?>" method="post" action="free_comment_modify_delete_reply_insert.php?num=<?= $num ?>&reply_id=<?= $com_id ?>&com_num=<?= $com_num ?>&class_code=<?= $class_code ?>">
								<textarea id='<?php echo $com_num; ?>' name="reply_content" style="padding: 10px; display:none; width:100%; height:80%" placeholder=""></textarea>
								<div style="margin-top:0.2em; margin-bottom:0.2em; float:left; width:100%">
									<button name='i<?php echo $com_num; ?>' type="button" onclick="reply_input('<?php echo $com_num; ?>', 'i')">답글</button>
									<?php
									if ($userid == $com_id) {
									?>


										<button name='m<?php echo $com_num; ?>' type="button" onclick="reply_input('<?php echo $com_num; ?>', 'm')">수정</button>
										<button name='d<?php echo $com_num; ?>' type="button" onclick="check_mi_input('<?php echo $com_num; ?>', 'd')">삭제</button>
									<?php
									}
									?>

									<button id='cancel<?php echo $com_num; ?>' type="button" style="margin-left:0.5em; float:right; display:none;" onclick="cancel('<?php echo $com_num; ?>')">취소</button>
									<button id='complete<?php echo $com_num; ?>' type="button" style="float:right; display:none; " onclick="">완료</button>

								</div>
							</form>
							<?php
							$sql = "select rep_num, id, content, regist_day, rep_id  from free_reply where class_code='$class_code' and num=$num and com_num=$com_num";
							$reply_result = mysqli_query($con, $sql);
							$reply_total_record = mysqli_num_rows($reply_result);

							for ($j = 0; $j < $reply_total_record; $j++) {
								mysqli_data_seek($reply_result, $j);
								// 가져올 레코드로 위치(포인터) 이동
								$reply_row = mysqli_fetch_array($reply_result);
								// 하나의 레코드 가져오기
								$reply_id          = $reply_row["id"];
								$reply_num     = $reply_row["rep_num"];
								$reply_content     = $reply_row["content"];
								$reply_regist_day  = $reply_row["regist_day"];
								$reply_to_id       = $reply_row["rep_id"];
							?>

								<div style="margin-left:1em;">
									<div>
										<span style="font-weight: bold; width: <?php echo (mb_strlen($reply_id, 'utf-8')) * 5; ?>px"><i class="fas fa-angle-right" style="margin-left:0.2em;"></i> <?= $reply_id ?></span>
										<span style="width: <?php echo (mb_strlen($reply_to_id, 'utf-8')) * 5; ?>px"> @<?= $reply_to_id ?></span>
										<span style="width: <?php echo (mb_strlen($reply_regist_day, 'utf-8')) * 5; ?>px; font-size:10px"> | <?= $reply_regist_day ?></span>
									</div>
									<div>
										<span><?= $reply_content ?></span>
									</div>

								</div>

								<form name="free_reply_reply<?php echo $reply_num; ?>" method="post" action="free_reply_modify_delete_insert.php?reply_num=<?= $reply_num ?>&num=<?= $num ?>&reply_id=<?= $reply_id ?>&com_num=<?= $com_num ?>&class_code=<?= $class_code ?>">
									<textarea id='<?php echo $reply_num; ?>' name="reply_content" style="padding: 10px; margin-left:1em; display:none; width:100%; height:80%" placeholder=""></textarea>
									<div style="margin-left:1em; margin-top:0.2em; margin-bottom:0.2em; float:left; width:100%">
										<button name='i<?php echo $reply_num; ?>' type="button"  onclick="reply_reply_input('<?php echo $reply_num; ?>', 'i')">답글</button>

										<?php
										if ($userid == $reply_id) {
										?>
											<button name='m<?php echo $reply_num; ?>' type="button" onclick="reply_reply_input('<?php echo $reply_num; ?>', 'm')">수정</button>
											<button name='d<?php echo $reply_num; ?>' type="button" onclick="check_reply_mi_input('<?php echo $reply_num; ?>', 'd')">삭제</button>
										<?php
										}
										?>
										<button id='cancel_reply<?php echo $reply_num; ?>' type="button" style="margin-left:0.5em; float:right; display:none;" onclick="reply_cancel('<?php echo $reply_num; ?>')">취소</button>
										<button id='complete_reply<?php echo $reply_num; ?>' type="button" style="float:right; display:none;" onclick="">완료</button>
									</div>


								</form>


							<?php
							}
							?>


						<?php
						}
						mysqli_close($con);
						?>

					</div> <!-- board_box -->
				</div>
			</div>
		</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="js/scripts.js"></script>
		<script>
			var where = '<?php echo $where; ?>';
			var num = '<?php echo $num; ?>';

			function modify() {
				var class_code = '<?php echo $class_code; ?>';
				var btn;

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

				document.getElementById("comment_textarea").value = "";
			}

			function check_mi_input(s, flag) {
				if (!document.getElementById(s).value) {
					if (flag != 'd') {
						document.getElementById(s).focus();
						alert("내용을 입력하세요!");
						return;
					}
				}
				var form_name = 'free_reply' + s;

				if (flag == 'm') {
					document.forms[form_name].action += "&flag=m";
				} else if (flag == 'i') {
					document.forms[form_name].action += "&flag=i";
				} else {
					document.forms[form_name].action += "&flag=d";
				}

				document.forms[form_name].submit();

				document.getElementById(s).placeholder = "";
				document.getElementById(s).value = "";
				document.getElementById(s).style.display = 'none';
			}

			function check_reply_mi_input(s, flag) {
				if (!document.getElementById(s).value) {
					if (flag != 'd') {
						document.getElementById(s).focus();
						alert("내용을 입력하세요!");
						return;
					}
				}
				var form_name = 'free_reply_reply' + s;

				if (flag == 'm') {
					document.forms[form_name].action += "&flag=m";
				} else if (flag == 'i') {
					document.forms[form_name].action += "&flag=i";
				} else {
					document.forms[form_name].action += "&flag=d";
				}

				document.forms[form_name].submit();

				document.getElementById(s).placeholder = "";
				document.getElementById(s).value = "";
				document.getElementById(s).style.display = 'none';
			}

			function reply_input(s, flag) {
				if (document.getElementById(s).style.display == 'none') {
					document.getElementById(s).style.display = 'block';
					document.getElementById('cancel' + s).style.display = 'inline-block';
					document.getElementById('complete' + s).style.display = 'inline-block';

					if (flag == 'm') {
						document.getElementById('complete' + s).setAttribute("onClick", "check_mi_input(" + s + ", 'm')");
						document.getElementById(s).placeholder = "수정할 내용을 입력하세요.";
					} else {
						document.getElementById('complete' + s).setAttribute("onClick", "check_mi_input(" + s + ", 'i')");
						document.getElementById(s).placeholder = "답글을 입력하세요.";
					}

				} else if (document.getElementById(s).placeholder != "") {
					if (flag == 'm') {
						document.getElementById('complete' + s).setAttribute("onClick", "check_mi_input(" + s + ", 'm')");
						document.getElementById(s).placeholder = "수정할 내용을 입력하세요.";
					} else {
						document.getElementById('complete' + s).setAttribute("onClick", "check_mi_input(" + s + ", 'i')");
						document.getElementById(s).placeholder = "답글을 입력하세요.";
					}

				}
			}

			function reply_reply_input(s, flag) {
				if (document.getElementById(s).style.display == 'none') {
					document.getElementById(s).style.display = 'block';
					document.getElementById('cancel_reply' + s).style.display = 'block';
					document.getElementById('complete_reply' + s).style.display = 'block';
					if (flag == 'm') {
						document.getElementById('complete_reply' + s).setAttribute("onClick", "check_reply_mi_input(" + s + ", 'm')");
						document.getElementById(s).placeholder = "수정할 내용을 입력하세요.";
					} else {
						document.getElementById('complete_reply' + s).setAttribute("onClick", "check_reply_mi_input(" + s + ", 'i')");
						document.getElementById(s).placeholder = "답글을 입력하세요.";
					}

				} else if (document.getElementById(s).placeholder != "") {
					if (flag == 'm') {
						document.getElementById('complete_reply' + s).setAttribute("onClick", "check_reply_mi_input(" + s + ", 'm')");
						document.getElementById(s).placeholder = "수정할 내용을 입력하세요.";
					} else {
						document.getElementById('complete_reply' + s).setAttribute("onClick", "check_reply_mi_input(" + s + ", 'i')");
						document.getElementById(s).placeholder = "답글을 입력하세요.";
					}

				}
			}

			function cancel(s) {
				document.getElementById(s).style.display = 'none';
				document.getElementById(s).value = "";
				document.getElementById(s).placeholder = "";
				document.getElementById('complete' + s).style.display = 'none';
				document.getElementById('cancel' + s).style.display = 'none';
			}

			function reply_cancel(s) {
				document.getElementById(s).style.display = 'none';
				document.getElementById(s).value = "";
				document.getElementById(s).placeholder = "";
				document.getElementById('complete_reply' + s).style.display = 'none';
				document.getElementById('cancel_reply' + s).style.display = 'none';
			}
		</script>

	</body>


	</html>

<?php
} else {
	echo "<h1>잘못된 접근 방식입니다.</h1>";
}

?>
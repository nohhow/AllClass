<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
?>

<nav class="sb-topnav navbar navbar-expand navbar-light bg-light" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-0 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="class_index.php">모두의 클래스</a>
    <!-- Navbar Search -->
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-md-3 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li class="dropdown-item"><?= $userid . "(" . $username . ")님" ?></li>
                <li><a class="dropdown-item" href="member_modify_form.php">정보 수정</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="logout.php">로그아웃</a></li>
            </ul>
        </li>
    </ul>
</nav>
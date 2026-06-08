<?php

require_once "session.php";

if (isset($_SESSION['usuario'])) {
    session_destroy();
}

header("Location: ../pages/login.php");
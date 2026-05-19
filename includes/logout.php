<?php

require_once "session.php";

if (isset($_SESSION)){
        session_destroy();
        header ("location: ../pages/login.php");
}

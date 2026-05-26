<?php
$senha = 123456;

$nova_senha = password_hash ( $senha, PASSWORD_DEFAULT);

echo $nova_senha;
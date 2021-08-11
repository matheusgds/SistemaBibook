<?php

unset($_SESSION['loginextra']);
unset($_SESSION['senhaextra']);

$linkprincipal = ".." . DIRECTORY_SEPARATOR . "index.php";

header('location:'.$linkprincipal);

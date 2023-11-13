<?php

foreach ($_ENV as $key => $value) {
    $_SERVER[$key] = $value;
}

require '../bootstrap.php';

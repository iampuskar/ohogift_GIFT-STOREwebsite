<?php
session_start();
session_destroy();

if (isset($_COOKIE['_au_us_ad'])) {
	setcookie('_au_us_ad', '', (time() - 60), '/pasalesghar');
}

@header('location: ./');
exit;
<?php 

$conn = new mysqli('localhost', 'root', '', 'myapp');

if (!$conn) {
	echo "Koneksi Gagal!";
	exit();
}
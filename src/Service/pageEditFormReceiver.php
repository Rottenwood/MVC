<?php

var_dump($_FILES);
var_dump($_FILES['avatar']);

$uploaddir = '/var/www/aurora/upload/';
$uploadfile = $uploaddir . basename($_FILES['avatar']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    die("Возможная атака с помощью файловой загрузки!\n");
}

//$stmt = $mysqli->prepare("INSERT INTO pics(pic) VALUES (?)");
//$stmt->bind_param('sssdi', $_POST['filmName']);
//$stmt->execute();
//$stmt->close();
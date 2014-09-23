<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?php echo $data['title']; ?></title>
</head>
<body>

<h1><?php echo $data['title']; ?></h1>

<b>Навигация: </b>

<a href="<?php echo $data['url']; ?>/" class="<?php echo $data['class']['main']; ?>">Главная</a> |
<a href="<?php echo $data['url']; ?>/page" class="<?php echo $data['class']['page']; ?>">Страницы</a> |
<a href="<?php echo $data['url']; ?>/users" class="<?php echo $data['class']['users']; ?>">Пользователи</a> |
<a href="<?php echo $data['url']; ?>/catalog" class="<?php echo $data['class']['catalog']; ?>">Каталог</a> |
<a href="<?php echo $data['url']; ?>/logout">Выход</a>

<br><br>

<?php include 'src/View/' . $contentView; ?>

</body>
</html>

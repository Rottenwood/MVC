<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $data['title'] ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" href="<?php echo $data['url'] ?>/assets/css/style.css" rel="stylesheet"/>
    <?php echo $data['htmlHead'] ?>
</head>
<body>

<h1><?php echo $data['title']; ?></h1>

<?php if ($data['noMenu'] != 1) { ?>
    <div id="navigation">
        <span>Навигация:</span>
        <a href="<?php echo $data['url'] ?>/" class="<?php echo $data['class']['main'] ?> ">Главная</a> |
        <a href="<?php echo $data['url'] ?>/page" class="<?php echo $data['class']['page'] ?> ">Страницы</a> |
        <a href="<?php echo $data['url'] ?>/users" class="<?php echo $data['class']['users'] ?> ">Пользователи</a> |
        <a href="<?php echo $data['url'] ?>/catalog" class="<?php echo $data['class']['catalog'] ?> ">Каталог</a> |
        <a href="<?php echo $data['url'] ?>/logout">Выход</a>
    </div>
<?php } ?>

<?php include 'src/View/' . $contentView; ?>

</body>
</html>

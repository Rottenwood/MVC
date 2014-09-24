<p><a href="<?php echo $data['url'] . '/create' ?>">Добавить новую страницу</a></p>
<p>Список страниц:</p>
<ul></ul>
<?php foreach ($data['pages'] as $page) { ?>
    <li><a href="<?php echo $page['url'] . 'page/' . $page['alias'] ?>"><?php echo $page['title'] ?></a></li>
<?php } ?>

<div class="article">
    <img src="<?php echo $data['pic'] ?>">
    <p><a href="<?php echo $data['url'] . '/edit/' . $data['id'] ?>">Редактировать</a> |
        <a href="<?php echo $data['url'] . '/delete/' . $data['id'] ?>">Удалить</a></p>
<?php echo $data['content'] ?>
</div>

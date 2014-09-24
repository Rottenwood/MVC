<div class="article">
    <?php if ($data['pic'] != '') { ?>
        <img src="<?php echo $data['url'] . '/upload/' . $data['pic'] ?>">
    <?php } ?>
    <p><a href="<?php echo $data['url'] . '/edit/' . $data['id'] ?>">Редактировать</a> |
        <a href="<?php echo $data['url'] . '/delete/' . $data['id'] ?>">Удалить</a></p>
    <?php echo $data['content'] ?>
</div>

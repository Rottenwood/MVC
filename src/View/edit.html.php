<?php if ($data['notFound']) { ?>
    <p></p>
<?php } ?>
<div class="edit">
    <table>
        <tr>
            <form enctype="multipart/form-data" action="<?php echo $data['url'] ?>/src/Service/pageEditFormReceiver.php"
                  method="POST">
                <td><img src="<?php echo $data['pic'] ?>"></td>
                <td class="text"><textarea><?php echo $data['content'] ?></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="50000">
                <!-- Название элемента input определяет имя в массиве $_FILES -->
                <p>Загрузка изображения: </p>
                <input name="avatar" type="file" class="button">
            </td>
            <td>
                <input type="submit" value="Сохранить" class="button">
<!--                <button>Сохранить</button>-->
            </td>
            </form>
        </tr>
    </table>
</div>

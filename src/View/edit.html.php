<?php if ($data['notFound']) { ?>
    <p></p>
<?php } ?>
<div class="edit">
    <table>
        <tr>
            <form id="editForm" enctype="multipart/form-data" action="<?php echo $data['url']
            ?>/service/pageEditFormReceiver.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <input type="hidden" name="pic" value="<?php echo $data['pic'] ?>">
                <td>
                    <?php if ($data['pic'] != '') { ?>
                        <img src="<?php echo $data['url'] . '/upload/' . $data['pic'] ?>">
                    <?php } else { ?>
                        <p>Загрузка изображения: </p>
                        <input name="avatar" type="file" class="button">
                    <?php } ?>
                </td>
                <td class="text">
                    <input type="text" name="title" class="titleform" value="<?php echo $data['pageTitle'] ?>">
                    <textarea id="context-area" name="context" form="editForm"><?php echo $data['content'] ?></textarea>
                </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <?php if ($data['pic'] != '') { ?>
                    <p>Загрузка изображения: </p>
                    <input name="avatar" type="file" class="button">
                <?php } ?>

            </td>
            <td>
                <input type="submit" value="Сохранить" class="button"
                       onclick="nicEditors.findEditor('context-area').saveContent();">
            </td>
            </form>
        </tr>
    </table>
</div>

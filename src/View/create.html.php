<div class="create">
    <table>
        <tr>
            <form enctype="multipart/form-data" action="<?php echo $data['url']
            ?>/service/pageCreateFormReceiver.php"
                  method="POST">
                <input type="hidden" name="pic" value="">
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    <p>Загрузка изображения: </p>
                    <input name="avatar" type="file" class="button">
                </td>
                <td class="text">
                    <input type="text" name="title" class="titleform" placeholder="Название страницы">
                    <textarea id="context-area" name="context"></textarea>
                </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="submit" value="Сохранить" class="button" onclick="nicEditors.findEditor('context-area').saveContent();">
            </td>
            </form>
        </tr>
    </table>
</div>

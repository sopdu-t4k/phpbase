<h1>Отзывы</h1>
<? if(!empty($message)): ?>
<div class="alert <?=$success?'alert-success':'alert-danger';?> mb-4 mt-4" role="alert">
    <?=$message;?>
</div>
<? endif; ?>
<? if (isset($comments)): ?>
    <? foreach ($comments as $comment): ?>
    <div class="media mt-4 mb-4" id="comment_<?=$comment['id'];?>">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <? if ($comment['id'] == $id_edit): ?>
            <form method="post" action="/comments/edit/<?=$id_edit;?>">
                <div class="form-group">
                    <input name="user" class="form-control" value="<?=$comment['user'];?>" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" required><?=$comment['message'];?></textarea>
                </div>
                <button type="submit" name="save" class="btn btn-success btn-sm mr-sm-2">Сохранить</button>
                <a href="/comments/" class="btn btn-secondary btn-sm mr-sm-2">Отменить</a>
            </form>
            <? else: ?>
            <h5 class="mt-0"><?=$comment['user'];?></h5>
            <p class="text-muted">Отзыв о <a href="/tovar/<?=$comment['good_id'];?>">товаре</a></p>
            <?=$comment['message'];?>
            <div class="mt-3">
                <button data-action="delete" data-id="<?=$comment['id'];?>" class="btn btn-danger btn-sm mr-sm-2">Удалить</button>
                <a href="/comments/edit/<?=$comment['id'];?>" class="btn btn-info btn-sm mr-sm-2">Изменить</a>
                <button data-action="public" data-id="<?=$comment['id'];?>" class="btn btn-warning btn-sm mr-sm-2"><?=$comment['public']==0?'Опубликовать':'Отменить публикацию';?></button>
            </div>
        <? endif; ?>
        </div>
    </div>
    <? endforeach; ?>
<? endif; ?>

<h1>Отзывы</h1>
<? if(!empty($message)): ?>
<div class="alert <?=$success?'alert-success':'alert-danger';?> mb-4 mt-4" role="alert">
    <?=$message;?>
</div>
<? endif; ?>
<? if (isset($comments)): ?>
    <? foreach ($comments as $comment): ?>
    <div class="media mt-4 mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
        <? if ($comment['id'] == $id_edit): ?>
            <form method="post" action="/reviews/edit/<?=$id_edit;?>">
                <div class="form-group">
                    <input name="user" class="form-control" value="<?=$comment['user'];?>" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" required><?=$comment['message'];?></textarea>
                </div>
                <button type="submit" name="save" class="btn btn-success btn-sm">Сохранить</button>
                <a href="/reviews/" class="btn btn-secondary btn-sm">Отменить</a>
            </form>
        <? else: ?>
            <h5 class="mt-0"><?=$comment['user'];?></h5>
            <p class="text-muted">Отзыв о <a href="/tovar/<?=$comment['good_id'];?>">товаре</a></p>
            <?=$comment['message'];?>
            <div class="mt-3">
                <a href="/reviews/delete/<?=$comment['id'];?>" class="btn btn-danger btn-sm mr-sm-2">Удалить</a>
                <a href="/reviews/edit/<?=$comment['id'];?>" class="btn btn-info btn-sm">Изменить</a>
            </div>
        <? endif; ?>
        </div>
    </div>        
    <? endforeach; ?>
<? endif; ?>

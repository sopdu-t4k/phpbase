<h2 class="my-3">Карточка товара</h2>
<form method="post" action="/goods/update/<?=$good['id'];?>" enctype="multipart/form-data" class="my-5" name="product">
    <div class="form-group row">
        <label class="col-2 col-form-label"><b>Изображение</b></label>
        <div class="col-2">
            <div class="border position-relative" id="product-img">
                <? if(!empty($good['image'])): ?>
                <button type="button" class="btn btn-danger delfile" title="Удалить изображение">&times;</button>
                <img src="/catalog-img/<?=$good['image'];?>" class="d-block mx-auto img-fluid" alt="<?=$good['name'];?>">
                <input type="checkbox" name="remove" hidden>
                <? endif; ?>
            </div>
        </div>
        <div class="col-7 align-self-end">    
            <div class="form-group">
                <label>Изменить изображение:</label>
                <input type="file" name="image" class="form-control-file">
            </div>  
        </div>
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label"><b>Наименование</b></label>
        <div class="col-sm-10">
            <input tite="text" name="name" value="<?=$good['name']?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label"><b>Цена</b></label>
        <div class="input-group col-10">
            <input tite="text" name="price" value="<?=$good['price'];?>" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">руб.</span>
                <span class="input-group-text">0.00</span>
            </div>
        </div>    
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label"><b>Скидка</b></label>
        <div class="input-group col-2">
            <input tite="text" name="discount" value="<?=empty($good['discount'])?'0':$good['discount'];?>" class="form-control">
            <div class="input-group-append">
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-8 form-check pt-2">
            <label class="form-check-label">
                <input type="checkbox" name="sale" class="form-check-input" <?=$good['sale']==1?'checked':'';?>>
                Включить в акцию
            </label>
        </div>
    </div>
    <div class="form-group">
        <label><b>Описание</b></label>
        <textarea name="description" class="form-control" rows="10"><?=$good['description'];?></textarea>
    </div>
    <a href="/goods/" class="btn btn-secondary mr-sm-2">Отменить</a>
    <input type="reset" class="btn btn-light">
    <input type="submit" name="send" value="Сохранить" class="btn btn-success w-25 float-right">
</form>

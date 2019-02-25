<h2>Добро пожаловать!</h2>
<p class="lead my-3"><b>В нашем магазине Вы найдете <b class="text-danger"><?=$goods['count'];?></b> товаров по самой выгодной цене!</b></p>
<hr/>
<h3>Новые поступления</h3>
<div class="row">
    <div class="col-4">
        <a href="/tovar/<?=$last_good['id'];?>" title="Подробнее">
             <img src="/catalog-img/<?=!empty($last_good['image'])?$last_good['image']:'no-thumb.png';?>" class="d-block ml-auto img-fluid" alt="<?=$last_good['name'];?>">
        </a>
    </div>
    <div class="col-8">
        <a href="/tovar/<?=$last_good['id'];?>" class="text-body">
            <p class="h4"><?=$last_good['name'];?></p>
        </a>
        <p><?=$last_good['description'];?></p>
        <span class="h4 text-danger"><?=$last_good['price'];?> руб.</span>
        <button data-action="buy" data-id="<?=$last_good['id'];?>" class="btn btn-success btn-sm w-25 mx-5">Купить</button>
    </div>
</div>
<div class="mb-4 alert" role="alert" id="message" style="display: none"></div>
<hr/>
<h3>Отзывы о наших товарах</h3>
<div class="row my-4">
    <div class="col-8">
        <div class="alert alert-secondary mt-3">
            <p class="h6 mb-3"><strong><?=$comment_good['user'];?></strong> о товаре <a class="alert-link" href="/tovar/<?=$comment_good['id'];?>"><?=$comment_good['name'];?></a></p>
            <p class="mb-0"><?=$comment_good['message'];?></p>
        </div> 
    </div>
    <div class="col-2 mx-auto">
        <a href="/tovar/<?=$comment_good['id'];?>" title="<?=$comment_good['name'];?>">
            <img src="/catalog-img/<?=!empty($comment_good['image'])?$comment_good['image']:'no-thumb.png';?>" class="d-block ml-auto img-fluid" alt="<?=$comment_good['name'];?>">
            <p class="h4 text-danger text-right"><?=$comment_good['price'];?> руб.</p>
        </a>
    </div>
</div>

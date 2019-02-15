<ul class="nav">
    <? foreach ($menu as $item): ?>
    <li class="<?=(isset($item['items']))?'nav-item dropdown':'nav-item';?>">
        <a href="<?=$item['href'];?>" class="nav-link text-white">
            <?=$item['name'];?>
        </a>
        <?=(isset($item['items']))?renderTemplate('menu', ['menu' => $item['items']]):'';?>
    </li>
    <? endforeach; ?>
</ul>

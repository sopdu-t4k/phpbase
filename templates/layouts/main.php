<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?=$title;?></title>
        <base href="/" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="/css/main.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body class="min-vh-100">
        <div class="min-vh-100 d-flex flex-column">
            <header class="bg-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <?=$menu;?>
                        </div>
                        <div class="col-2">
                            <a href="/basket/" class="btn btn-link text-white">
                                Корзина
                                <? if (!empty($cart)): ?>
                                <span class="badge badge-warning ml-1" id="cart"><?=$cart['count'];?></span>
                                <? endif; ?>
                            </a>
                        </div>
                    </div>
                    
                    
                </div>
            </header>
            <? if($allow): ?>
            <div class="bg-light">
                <div class="container">
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand" href="/admin/">Мой сайт</a>
                        <ul class="nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="/gallery/">Галерея</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="/comments/">Отзывы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="/orders/">Заказы</a>
                            </li>
                        </ul>
                        <span class="ml-auto mr-4"><?=$user;?></span>
                        <a href="?logout" class="btn btn-outline-info">Выход</a>
                    </nav>
                </div>
            </div>
            <? endif; ?>
            <main class="container mt-4">
                <?=$content;?>
            </main>
            <footer class="bg-secondary text-white text-center p-2 mt-auto">
                <small>&copy;<?=$year;?></small>
            </footer>
        </div>
        <script src="/js/main.js"></script>
    </body>
</html>

<? if(!$allow): ?>
<div class="row justify-content-center">
    <div class="col-4 bg-light p-5">
        <h5 class="text-center">Авторизация</h5>
        <form method="post">
            <div class="form-group">
                <input type="text" name="login" placeholder="Логин" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="Пароль" class="form-control">
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <small>Запомнить пароль</small>
                </label>
            </div>
            <button type="submit" class="btn btn-info w-50 d-block mx-auto" name="enter" >Войти</button>
        </form>
    </div>
</div>
<? else: ?>
<div class="row">
    <div class="col-4 text-center mt-3">
        <a href="/orders/">
            <div class="alert alert-info py-5 lead shadow-sm">
                Оформленные заказы
            </div>
        </a>
    </div>
    <div class="col-4 text-center mt-3">
        <a href="/comments/">
            <div class="alert alert-info py-5 lead shadow-sm">
                Модерация отзывов
            </div>
        </a>
    </div>
    <div class="col-4 text-center mt-3">
        <a href="/gallery/">
            <div class="alert alert-info py-5 lead shadow-sm">
                Редактировать галерею
            </div>
        </a>
    </div>
</div>
<? endif; ?>

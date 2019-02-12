<?php
function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'content' => renderTemplate($page, $params),
        'menu' => renderTemplate('menu', $params),
        'title' => 'Название сайта', 
        'year' => '2019',
    ]);
}

function renderTemplate($page, $params = []) {
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $fileName = TEMPLATES_DIR . "{$page}.php";
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die('404 Страницы не существует!');
    }
    return ob_get_clean();
}

function renderMenu($listItem, $parent = '') {
    $content = '<ul class="nav">';
    foreach ($listItem as $value) {
        $href = $parent . $value['href'];
        if (isset($value['items']) && !is_null($value['items'])) {
            $content .= "<li class='nav-item dropdown'><a href='{$href}'>{$value['name']}</a>" . renderMenu($value['items'], $href) . "</li>";
        } else {
            $content .= "<li class='nav-item'><a href='{$href}' class='nav-link text-white'>{$value['name']}</a></li>";
        }
    }
    $content .= '</ul>';
    return $content;
}

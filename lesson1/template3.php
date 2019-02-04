<?php
$placeholders = array('{{TITLE}}', '{{HEADER}}', '{{YEAR}}');
$values = array('Php base', 'Базовый курс PHP', 2019);

$content = file_get_contents('template.tpl');
$content = str_replace($placeholders, $values, $content);

echo $content;

<?php
echo '<h4>Задание 1</h4>';
$a = rand(-10, 10);
$b = rand(-10, 10);

function match(int $x, int $y) {
    $rez = 0;
    if ($x >= 0 && $y >= 0) {
        $rez = $x - $y;
        echo 'разность: ';
    } else if ($x <0 && $y < 0) {
        $rez = $x * $y;
        echo 'произведение: ';
    } else {
        $rez = $x + $y;
        echo 'сумма: ';
    }
    return $rez;
}
echo "a = {$a}, b = {$b}<br>";
echo match($a, $b);

echo '<h4>Задание 2</h4>';
$c = rand(0, 15);
switch ($c) {
    case 0:
        echo "$c ";
        $c++;
    case 1:
        echo "$c ";
        $c++;
    case 2:
        echo "$c ";
        $c++;
    case 3:
        echo "$c ";
        $c++;
    case 4:
        echo "$c ";
        $c++;
    case 5:
        echo "$c ";
        $c++;
    case 6:
        echo "$c ";
        $c++;
    case 7:
        echo "$c ";
        $c++;
    case 8:
        echo "$c ";
        $c++;
    case 9:
        echo "$c ";
        $c++;
    case 10:
        echo "$c ";
        $c++;
    case 11:
        echo "$c ";
        $c++;
    case 12:
        echo "$c ";
        $c++;
    case 13:
        echo "$c ";
        $c++;
    case 14:
        echo "$c ";
        $c++;
    case 15:
        echo "$c ";
}
echo '<p>Второй вариант</p>';
function writeNumber($x) {
    echo "$x ";
    if ($x < 15) {
        $x++;
        writeNumber($x);
    }
}
writeNumber(10);

echo '<h4>Задание 3</h4>';
function add($x, $y) : int {
    return $x + $y;
}
function sub($x, $y) : int {
    return $x - $y;
}
function mult($x, $y) : int {
    return $x * $y;
}
function div($x, $y) {
    return ($y != 0) ? $x / $y : 'деление на 0 недопустимо'; 
}
echo '<pre>';
echo add(2,-1) . PHP_EOL;
echo sub(7,2) . PHP_EOL;
echo mult(4,5) . PHP_EOL;
echo div(9,3) . PHP_EOL;
echo '</pre>';

echo '<h4>Задание 4</h4>';
function mathOperation($arg1, $arg2, $operation) {
    $rez = 0;
    switch ($operation) {
        case 'add':
            $rez = add($arg1, $arg2);
            break;
        case 'sub':
            $rez = sub($arg1, $arg2);
            break;
        case 'mult':
            $rez = mult($arg1, $arg2);
            break;
        case 'div':
            $rez = div($arg1, $arg2);
            break;
        default:
            echo 'Не определен оператор';
    }
    return $rez;
}
echo mathOperation(18, 7, 'sub');

echo '<h4>Задание 6</h4>';
function power($val, $pow) {
    static $count = 0;
    if ($pow > 0) {    
        if ($count < $pow) {
            $count++;
            return $val * power($val, $pow);
        } else {
            return 1;
        }    
    } else {
        echo 'Значение степени должно быть больше 0';
    }
}
echo power(2, 5);

echo '<h4>Задание 7</h4>';
function declination($count, $one, $two, $five) {
    $n = $count % 10;
    $n10 = (int)($count / 10);
    if ($n === 1) {
        return "$count $one";
    } else if ($n >= 2 && $n <= 4 && $n10 !== 1) {
        return "$count $two";
    } else {
        return "$count $five";
    }
}
function showTime($hour, $min) {
    return declination($hour, 'час', 'часа', 'часов') . ' ' . declination($min, 'минута', 'минуты', 'минут');
}
echo showTime(21, 14);

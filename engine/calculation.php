<?php
function handleMathAction($action, $params) {
    if ($action == 'math') {
        $operand1 = (int)$_POST['ajx-operand1'];
        $operand2 = (int)$_POST['ajx-operand2'];
        $operation = $_POST['ajx-operation'];
        $params['ajx_rezult'] = mathOperation($operand1, $operand2, $operation);
        $params['is_ajax'] = true;
    }
    if (isset($_GET['submit'])) {
        $operand1 = (int)$_GET['operand1'];
        $operand2 = (int)$_GET['operand2'];
        $operation = $_GET['operation'];
        $params['operand1'] = $operand1;
        $params['operand2'] = $operand2;
        $params['rezult'] = mathOperation($operand1, $operand2, $operation);
    }
    $params['operations'] = getActionList();
    return $params;
}

function getActionList() {
    $operations = [
        [
            'option' => '+',
            'value' => 'plus',
        ],
        [
            'option' => '-',
            'value' => 'minus',
        ],
        [
            'option' => '*',
            'value' => 'mult',
        ],
        [
            'option' => '/',
            'value' => 'div',
        ],
    ];
    if (isset($_GET['operation'])) {
        array_walk($operations, function(&$operation) {
            $operation['selected'] = $operation['value'] == $_GET['operation'];
        });
    }
    return $operations;
}

function mathOperation($arg1, $arg2, $oper){
    $rez = 0;
    switch ($oper) {
        case 'plus':
            $rez = $arg1 + $arg2; break;
        case 'minus':
            $rez = $arg1 - $arg2; break;
        case 'mult':
            $rez = $arg1 * $arg2; break;
        case 'div':
            $rez = $arg2 != 0 ? $arg1 / $arg2 : 0;
    }
    return $rez;
}

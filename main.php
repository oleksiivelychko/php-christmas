<?php

include_once 'christmas-tree.php';

pcntl_signal(SIGINT, function () {
    echo "\nBye bye... Have yourself a Merry Christmas and Happy New Year!\n";
    exit(0);
});

$tree = new ChristmasTree(80, 20);
$clearTerminal = initClearTerminal();

while (true) {
    pcntl_signal_dispatch();

    $tree->draw();

    sleep(1);

    call_user_func($clearTerminal[PHP_OS]);
}

function initClearTerminal(): array
{
    $clearMap = [
        'Darwin' => function () { system('clear'); },
        'Linux' => function () { system('clear'); },
        'Windows' => function () { system("cmd /c cls"); },
    ];

    if (!array_key_exists(PHP_OS, $clearMap)) {
        echo sprintf("OS %s does not support!", PHP_OS);
        exit(1);
    }

    return $clearMap;
}


<?php

include_once 'christmas-tree.php';

pcntl_signal(SIGINT, function () {
    echo "\n\nCtrl+C pressed...\n\nBye bye... Have yourself a Merry Christmas and Happy New Year!\n";
    exit(0);
});

$tree = new ChristmasTree(...getDimensions());
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
        echo sprintf("Platform %s is undefined!", PHP_OS);
        exit(1);
    }

    return $clearMap;
}

function getDimensions(): array
{
    $cols = (int) exec('tput cols');
    $rows = (int) exec('tput lines');

    $remainder = $cols % 2;
    if (0 !== $remainder) {
        $cols -= $remainder;
    }

    $remainder = $rows % 10;
    if (0 !== $remainder) {
        $rows -= $remainder;
    }

    return [$cols / 2, $rows / 2];
}

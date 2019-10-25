<?php

$files = glob('files/*.txt');  // Сразу после запуска скрипт выбирает все файлы с расширением *.txt из папки files

$files or exit('Нет файлов для проверки.'.PHP_EOL); //

echo 'файлы в папке: '.count($files).PHP_EOL;
foreach ($files as $index => $name) {
    echo "[{$index}] => {$name}".PHP_EOL;
}

echo 'Выберите файл: ';
$choice = intval(fgets(STDIN));


array_key_exists($choice, $files) or exit('Выбран неверный файл. '.PHP_EOL);

$file = $files[$choice];

echo "Обработка файла '{$file}'..." . PHP_EOL;

$fp = fopen($file, "r"); // Открываем файл в режиме чтения
if ($fp) {
    while (!feof($fp)) {
        $mytext = fgets($fp, 999);
        echo $mytext;
    }
} else echo "Ошибка при открытии файла";
fclose($fp);


    $operation = readline("Введите тип операции (*, /, +, -): ");


writeTo($file,$operation);

function writeTo($file,$operation)
{

    $files = fopen($file, 'r');
    if (!$files){ return false; }

        while (!feof($files)) {
            $line = fgets($files, 9999);
            $data = explode(" ", $line);
            try {
                $result = eval('return ' . $data['0'] . $operation . $data['1'] . ';');
            } catch (Throwable $t) {
                $result = null;
            }
            if ($result > 0)
                writeToFile("+", $result);
            else
                writeToFile("-", $result);
        }


    fclose($files);
    echo "Результат успешна записан";
    return  true;
}



function writeToFile($filename, $txt)
{
    $file = fopen($filename, "a") or die("Unable to open file!");
    fwrite($file, $txt . "\n");
    fclose($file);
}

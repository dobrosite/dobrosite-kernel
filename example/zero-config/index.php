<?php

/**
 * Пример файла, где мы хотим получить доступ к ядру.
 */

use DobroSite\CMS\Kernel\ScriptKernel;

// Подключение загрузчика классов Composer — единственное что требуется начала работы с ядром.
require dirname(dirname(__DIR__)).'/vendor/autoload.php';

// Теперь нам доступно ядро.
$kernel = ScriptKernel::getInstance();

printf("Environment: %s\n", $kernel->getEnvironment());
printf("Debug mode: %s\n", $kernel->isDebug() ? 'true' : 'false');
printf("Name: %s\n", $kernel->getName());
printf("Root directory: %s\n", $kernel->getRootDir());
printf("Cache directory: %s\n", $kernel->getCacheDir());
printf("Logs directory: %s\n", $kernel->getLogDir());
echo PHP_EOL;
printf("Service output: %s\n", $kernel->getContainer()->get('test_service')->getMessage());

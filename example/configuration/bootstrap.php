<?php

/**
 * Пример файла, определяющего конфигурацию ядра.
 */

use DobroSite\CMS\Kernel\Configuration;
use DobroSite\CMS\Kernel\ScriptKernel;

require dirname(dirname(__DIR__)).'/vendor/autoload.php';

$configuration = new Configuration();
$configuration
    ->setEnvironment('test')
    ->enableDebug()
    ->setRootDir(__DIR__)
    ->setCacheDir(__DIR__.'/cache')
    ->setLogDir(__DIR__.'/logs')
    ->setConfigDir(__DIR__.'/conf')
    ->addConfigFile('services.yaml');

ScriptKernel::setConfiguration($configuration);

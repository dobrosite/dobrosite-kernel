# Ядро (компонент Добро.сайт)

Ядро — узловая точка, связывающая вместе все используемые компоненты.

При разработке ядра сделан упор на следующие требования.

1. Ядро должно быть легко встроить в имеющееся приложение (как правило в CMS).

## Использование ядра из коробки

Для того, чтобы получить доступ к ядру, достаточно подключить загрузчик классов Composer:

```php
<?php

use DobroSite\CMS\Kernel\ScriptKernel;

require_once 'vendor/autoload.php';

$service = ScriptKernel::getInstance()->getContainer()->get('...');
```

Позволяет использовать:

1. контейнер зависимостей;
2. файлы настройки.

При этом ядро использует следующие значения:

- имя окружения (`Kernel::getEnvironment()`) — `prod`;
- режим отладки (`Kernel::isDebug()`) — отключен;
- корневая папка (`Kernel::getRootDir()`) — папка, в которой лежит файл `composer.lock`;
- папка кэша (`Kernel::getCacheDir()`) — `<системная папка для временных файлов>/<хэш sha1 от
  корневой папки>/cache/<имя окружения>`;
- папка журналов (`Kernel::getLogDir()`) — `<системная папка для временных файлов>/<хэш sha1 от
  корневой папки>/logs`;
- файлы настройки:
  - `config/services.yaml`.

## Собственная конфигурация ядра

Создайте файл PHP с произвольным именем (например `bootstrap.php`) и содержимым следующего вида:

```php
<?php

use DobroSite\CMS\Kernel\Configuration;

require_once 'vendor/autoload.php';

$configuration = new Configuration();
$configuration
    ->setConfigDir(__DIR__.'/config');

ScriptKernel::init($configuration);
```

Теперь вы можете подключить его ко всем нужным файлам, чтобы получить доступ к ядру:

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
  - `config/services.yaml`;
  - `config/services_<имя окружения>.yaml`.

## Собственная конфигурация ядра

Если значения по умолчанию, указанные выше, вам не подходят, вы можете переопределить их при помощи
класса [Configuration](src/Configuration.php). Для этого рекомендуется создать отдельный, например
с именем `bootstrap.php` следующего вида:

```php
<?php

use DobroSite\CMS\Kernel\Configuration;

require_once 'vendor/autoload.php';

$configuration = new Configuration();
$configuration
    ->setConfigDir(__DIR__.'/config');

ScriptKernel::setConfiguration($configuration);
```

Теперь вы можете подключить его ко всем нужным файлам вместо `autoload.php`:

```php
<?php

use DobroSite\CMS\Kernel\ScriptKernel;

require_once 'bootstrap.php';

$service = ScriptKernel::getInstance()->getContainer()->get('...');
```

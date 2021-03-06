<?php

/**
 * Система управления сайтами «Добро.сайт»
 *
 * @copyright 2017, Добро.сайт
 * @author    Михаил Красильников <m.krasilnikov@dobro.site>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace DobroSite\CMS\Kernel;

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * Начальный загрузчик ядра.
 *
 * @since 0.1
 */
class Bootloader
{
    /**
     * Выполняет все необходимые действия по подготовке и запуску ядра системы.
     *
     * Если имя окружения и режим отладки не заданы явно через аргументы, загрузчик попытается
     * получить их из переменных окружения DOBROSITE_ENV и DOBROSITE_DEBUG, соответственно. Если
     * переменная не указана или пуста, то будет использовано значение по умолчанию: «prod» для
     * $environment и false для $debug.
     *
     * @param string|null $environment Имя окружения.
     * @param bool|null   $debug       Управление режимом отладки.
     *
     * @throws \Exception
     *
     * @since 0.1
     */
    public function execute($environment = null, $debug = null)
    {
        $configuration = new Configuration();

        if ($environment === null) {
            $environment = (string) getenv('DOBROSITE_ENV');
            if ($environment === '') {
                $environment = 'prod';
            }
        }
        $configuration->setEnvironment($environment);

        if ($debug === null) {
            $debug = (bool) getenv('DOBROSITE_DEBUG');
        }

        if ($debug) {
            Debug::enable();
            $configuration->enableDebug();
        }

        $kernel = new ConfigurableKernel($configuration);
        $request = Request::createFromGlobals();
        $response = $kernel->handle($request);
        $response->send();
        $kernel->terminate($request, $response);
    }
}

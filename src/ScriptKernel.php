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

/**
 * Обёртка для использования ядра системы в сценариях.
 *
 * Этот класс позволяет сценариям легко поучить доступ к рабочему ядру.
 *
 * Пример:
 *
 * ```php
 * require 'vendor/autoload.php';
 * $kernel = ScriptKernel::getInstance();
 * $kernel->getContainer()->get('foo.bar')->…
 * ```
 *
 * @since 0.1
 */
final class ScriptKernel
{
    /**
     * Рабочий экземпляр ядра.
     *
     * @var KernelInterface
     */
    private static $kernel;

    /**
     * Возвращает текущий рабочий экземпляр ядра.
     *
     * @return KernelInterface
     *
     * @since 0.3
     */
    public static function getInstance()
    {
        if (self::$kernel === null) {
            self::$kernel = new Kernel('prod', false);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    /**
     * Запрещаем создавать экземпляры класса.
     */
    private function __construct()
    {
    }
}

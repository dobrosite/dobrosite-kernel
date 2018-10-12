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
     * Конфигурация ядра.
     *
     * @var Configuration|null
     */
    private static $configuration;

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
            self::$kernel = new ConfigurableKernel(self::$configuration);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    /**
     * Задаёт конфигурацию ядра.
     *
     * @param Configuration $configuration
     *
     * @return void
     *
     * @since 0.3
     */
    public static function setConfiguration(Configuration $configuration)
    {
        self::$configuration = $configuration;
    }

    /**
     * Задаёт используемое ядро.
     *
     * @param KernelInterface $kernel
     */
    public static function setKernel(KernelInterface $kernel)
    {
        self::$kernel = $kernel;
    }

    /**
     * Запрещаем создавать экземпляры класса.
     */
    private function __construct()
    {
    }
}

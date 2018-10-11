<?php

/**
 * Система управления сайтами «Добро.сайт»
 *
 * @copyright 2018, Добро.сайт
 * @author    Михаил Красильников <m.krasilnikov@dobro.site>
 *
 * @license   http://opensource.org/licenses/MIT MIT
 */

namespace DobroSite\CMS\Kernel;

/**
 * Конфигурация ядра.
 *
 * Т. к. ядро предполагает возможность встраивания в другие системы, его возможности по
 * автоматической настройке ограничены, ведь о целевой системе заранее ничего не известно. Поэтому
 * ряд важных параметров вынесен в отдельный объект, позволяющий задать конфигурацию той системы,
 * куда встраивается ядро.
 *
 * @since 0.1
 */
class Configuration
{
    /**
     * Папка кэша.
     *
     * @var string|null
     */
    private $cacheDir;

    /**
     * Папка настроек.
     *
     * @var string|null
     */
    private $configDir;

    /**
     * Шаблон имени главного файла конфигурации.
     *
     * @var string|null
     */
    private $configFileTemplate;

    /**
     * Флаг режима отладки.
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Имя окружения.
     *
     * @var string
     */
    private $environment = 'prod';

    /**
     * Список дополнительных файлов конфигурации.
     *
     * @var string[]
     */
    private $extraConfigFiles = [];

    /**
     * Папка журналов.
     *
     * @var string|null
     */
    private $logDir;

    /**
     * Корневая папка приложения.
     *
     * @var string|null
     */
    private $rootDir;

    /**
     * Добавляет дополнительный файл конфигурации.
     *
     * @param string $path
     *
     * @return $this
     *
     * @since 0.1
     */
    public function addExtraConfigFile($path)
    {
        $this->extraConfigFiles[] = $path;

        return $this;
    }

    /**
     * Включает режим отладки.
     *
     * @return $this
     *
     * @since 0.3
     */
    public function enableDebug()
    {
        $this->debug = true;

        return $this;
    }

    /**
     * Возвращает путь к папке кэша.
     *
     * @return string|null
     *
     * @since 0.3
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * Возвращает папку настроек.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getConfigDir()
    {
        return $this->configDir;
    }

    /**
     * Возвращает шаблон имени главного файла конфигурации.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getConfigFileTemplate()
    {
        return $this->configFileTemplate;
    }

    /**
     * Возвращает имя окружения.
     *
     * @return string
     *
     * @since 0.3
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Возвращает список дополнительных файлов конфигурации.
     *
     * @return string[]
     *
     * @since 0.1
     */
    public function getExtraConfigFiles()
    {
        return $this->extraConfigFiles;
    }

    /**
     * Возвращает путь к папке журналов.
     *
     * @return string|null
     *
     * @since 0.3
     */
    public function getLogDir()
    {
        return $this->logDir;
    }

    /**
     * Возвращает корневую папку приложения.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Возвращает состояние режима отладки.
     *
     * @return bool
     *
     * @since 0.3
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Задаёт путь к папке кэша.
     *
     * @param string $cacheDir
     *
     * @return $this
     *
     * @since 0.3
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;

        return $this;
    }

    /**
     * Задаёт папку настроек.
     *
     * @param string $configDir
     *
     * @return $this
     *
     * @since 0.1
     */
    public function setConfigDir($configDir)
    {
        $this->configDir = $configDir;

        return $this;
    }

    /**
     * Задаёт шаблон имени главного файла конфигурации.
     *
     * Используйте «%s» для указания места подстановки имени окружения (prod, test, dev…).
     *
     * @param string $configFileTemplate
     *
     * @return $this
     *
     * @since 0.1
     */
    public function setConfigFileTemplate($configFileTemplate)
    {
        $this->configFileTemplate = $configFileTemplate;

        return $this;
    }

    /**
     * Задаёт имя окружения.
     *
     * @param string $environment
     *
     * @return $this
     *
     * @since 0.3
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Задаёт путь к папке журналов..
     *
     * @param string $logDir
     *
     * @return $this
     *
     * @since 0.3
     */
    public function setLogDir($logDir)
    {
        $this->logDir = $logDir;

        return $this;
    }

    /**
     * Задаёт корневую папку приложения.
     *
     * @param string $rootDir
     *
     * @return $this
     *
     * @since 0.1
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

        return $this;
    }
}

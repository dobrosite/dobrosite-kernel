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
 * ряд важных параметров вынесен в отдельный объект (DTO), позволяющий задать конфигурацию той
 * системы, куда встраивается ядро.
 *
 * @since 0.1
 */
class Configuration
{
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
     * Список дополнительных файлов конфигурации.
     *
     * @var string[]
     */
    private $extraConfigFiles = [];

    /**
     * Корневая папка приложения.
     *
     * @var string|null
     */
    private $projectDir;

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
     * Возвращает корневую папку приложения.
     *
     * @return string|null
     *
     * @since 0.1
     */
    public function getProjectDir()
    {
        return $this->projectDir;
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
     * Задаёт корневую папку приложения.
     *
     * @param string $projectDir
     *
     * @return $this
     *
     * @since 0.1
     */
    public function setProjectDir($projectDir)
    {
        $this->projectDir = $projectDir;

        return $this;
    }
}

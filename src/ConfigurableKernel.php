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
 * Конфигурируемое ядро.
 *
 * @since 0.3
 */
class ConfigurableKernel extends AbstractKernel
{
    /**
     * Дополнительные файлы конфигурации.
     *
     * @var string[]|null
     */
    private $additionalConfigFiles = [];

    /**
     * Создаёт ядро.
     *
     * @param Configuration $configuration Конфигурация ядра.
     */
    public function __construct(Configuration $configuration = null)
    {
        if ($configuration === null) {
            $configuration = new Configuration();
        }

        parent::__construct($configuration->getEnvironment(), $configuration->isDebug());

        if ($configuration->getRootDir() !== null) {
            $this->rootDir = $configuration->getRootDir();
        }

        if ($configuration->getCacheDir() !== null) {
            $this->cacheDir = $configuration->getCacheDir();
        }

        if ($configuration->getLogDir() !== null) {
            $this->logDir = $configuration->getLogDir();
        }

        if ($configuration->getConfigDir() !== null) {
            $this->configDir = $configuration->getConfigDir();
        }

        foreach ($configuration->getConfigFiles() as $relativePath) {
            $this->additionalConfigFiles[] = $this->getConfigDir().'/'.ltrim($relativePath, '/');
        }
    }

    /**
     * Возвращает имена (включая путь) конфигурационных файлов.
     *
     * @return string[]
     *
     * @since 0.4
     */
    protected function getConfigurationFilenames()
    {
        return array_merge(
            parent::getConfigurationFilenames(),
            $this->additionalConfigFiles
        );
    }
}

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
     * Шаблон имени главного файла конфигурации.
     *
     * @var string
     */
    private $configFileTemplate = 'config.%s.yaml';

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

        if ($configuration->getConfigFileTemplate() !== null) {
            $this->configFileTemplate = $configuration->getConfigFileTemplate();
        }
    }

    /**
     * Возвращает параметры ядра.
     *
     * @return array
     */
    protected function getKernelParameters()
    {
        return array_merge(
            [
                'kernel.config_dir' => $this->getConfigDir(),
            ],
            parent::getKernelParameters()
        );
    }
}

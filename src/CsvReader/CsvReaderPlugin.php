<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/23
 * Time: 10:05
 */

namespace ESD\Plugins\CsvReader;

use ESD\BaseServer\Server\Context;
use ESD\BaseServer\Server\PlugIn\AbstractPlugin;

class CsvReaderPlugin extends AbstractPlugin
{
    /**
     * @var CsvReader
     */
    private $csvReader;
    /**
     * @var CsvReaderConfig|null
     */
    private $csvReaderConfig;

    /**
     * @return string
     */
    public function getName(): string
    {
        return "CsvReader";
    }

    /**
     * CsvReaderPlugin constructor.
     * @param CsvReaderConfig|null $csvReaderConfig
     * @throws \DI\DependencyException
     * @throws \ReflectionException
     */
    public function __construct(?CsvReaderConfig $csvReaderConfig = null)
    {
        parent::__construct();
        if ($csvReaderConfig == null) {
            $csvReaderConfig = new CsvReaderConfig();
        }
        $this->csvReaderConfig = $csvReaderConfig;
        if ($csvReaderConfig->getIncludePath() == null) {
            if (defined(RES_DIR)) {
                $csvReaderConfig->setIncludePath(RES_DIR . "/csv");
            }
        }
    }

    /**
     * 初始化
     * @param Context $context
     * @return mixed
     * @throws \ESD\BaseServer\Server\Exception\ConfigException
     */
    public function beforeServerStart(Context $context)
    {
        $this->csvReaderConfig->merge();
        if ($this->csvReaderConfig->getIncludePath() != null && is_dir($this->csvReaderConfig->getIncludePath())) {
            $this->csvReader = new CsvReader($this->csvReaderConfig->getIncludePath());
            $this->setToDIContainer(CsvReader::class, $this->csvReader);
        }
    }

    /**
     * 在进程启动前
     * @param Context $context
     * @return mixed
     */
    public function beforeProcessStart(Context $context)
    {
        $this->ready();
    }
}
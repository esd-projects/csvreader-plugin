<?php
/**
 * Created by PhpStorm.
 * User: 白猫
 * Date: 2019/5/23
 * Time: 10:13
 */

namespace ESD\Plugins\CsvReader;


use ESD\BaseServer\Plugins\Config\BaseConfig;

class CsvReaderConfig extends BaseConfig
{
    const key = "csv";

    protected $includePath;

    /**
     * CsvReaderConfig constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct(self::key);
    }

    /**
     * @return mixed
     */
    public function getIncludePath()
    {
        return $this->includePath;
    }

    /**
     * @param mixed $includePath
     */
    public function setIncludePath($includePath): void
    {
        $this->includePath = $includePath;
    }
}
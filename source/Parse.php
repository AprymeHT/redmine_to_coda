<?php

namespace Aero;

use Symfony\Component\Yaml\Yaml;

class Parse{

    public $redmineInfo;
    public $codaInfo;

    public function __construct($path)
    {
        // Парсинг yaml-файла
        $parseInfo = Yaml::parseFile($path);
        $this->redmineInfo = $parseInfo['redmineSettings'];
        $this->codaInfo = $parseInfo['codaSettings'];
    }

}
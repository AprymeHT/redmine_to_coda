<?php

namespace Aero;

class Sync
{
    public $coda;
    public $redmine;
    public $redmineLimit = 20;
    public $redmineTime = 168; //7 days
    public function __construct($path)
    {
        $parse = new Parse($path);
        $codaSettings = $parse->codaInfo;
        $redmineSettings = $parse->redmineInfo;

        $this->coda = new CodaCon(
            $codaSettings['tokenCoda'],
            $codaSettings['docId'],
            $codaSettings['table']
        );

        $this->redmine = new RedmineCon(
            $redmineSettings[$this->redmineTime],
            $redmineSettings[$this->redmineLimit],
            $redmineSettings['key'],
            $redmineSettings['url']
        );
    }

    public function sync()
    {
        $data = $this->redmine->getData();

        if(!$data) {
            return "Unexpected error.";
        }

        return $this->coda->addData($data);
    }
}

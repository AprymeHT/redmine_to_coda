<?php

namespace Aero;

use CodaPHP;

class CodaCon
{
    public $docId;
    public $table;
    public $client;
    public function __construct($tokenCoda, $docId, $table)
    {
        $this->client = new CodaPHP\CodaPHP($tokenCoda);
        $this->docId = $docId;
        $this->table = $table;
    }
    public function addData($info)
    {
        $arItems = $this->client->listRows($this->docId, $this->table);

        foreach ($arItems['items'] as $items)
        {
            $id = $items["values"]["ID"];
            if ($id && $info[$id]) {
                unset($info[$id]);
            }
        }

        $input = $this->client->insertRows(
            $this->docId,
            $this->table,
            $info
        );

        return $input;
    }
}

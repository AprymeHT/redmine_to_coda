<?php

namespace Aero;

use Redmine;

class RedmineCon
{
    public $limit;
    public $time;
    public $client;
    public function __construct($time, $limit, $url, $token)
    {
        $this->limit = $limit;
        $this->time = $time;
        $this->client = new Redmine\Client($url, $token);
    }

    public function getData()
    {
        $allTimes = $this->client->time_entry->all([
            'spent_on'=>$this->time,
            'limit' => $this->limit
        ]);

        if (!$allTimes[0]) {
            return [];
        }

        $currentDate = new \DateTime();
        foreach ($allTimes["time_entries"] as $time)
        {
            $arTimes[$time['id']] = [
                'ID' => $time['id'],
                'Пользователь' => $time['user']['name'],
                'Списано' => $time['hours'],
                'Проект' => $time['project']['name'],
                'Задача' => $time['issue']['id'] ?? 0,
                'Коммент' => $time['comments'],
                'Списано за' => $time['spent_on'],
                'Создано' => $time['created_on'],
                'Время импорта' => $currentDate->format('Y-m-d H:i:s')
            ];
        }

        return $arTimes;
    }
}

<?php

namespace PexelTS\Reports;

use TeamSpeakLogs\ReportController;
use TeamSpeakLogs\View;

class MostOnlineNicknameReport extends ReportController
{

    private $clients = [];

    /**
     * Returns view that is generated by this report controller.
     *
     * @return View resulting view
     */
    public function generate()
    {
        arsort($this->clients);

        return View::make('report.mostonlinenick', ['clients' => $this->clients]);
    }

    /**
     * Processes one data.
     *
     * @param mixed $oneData one data to process
     * @return void
     */
    public function process($oneData)
    {
        foreach ($oneData->channels as $channel) {
            foreach ($channel->clients as $client) {
                (isset($this->clients[$client->nickname]) ? $this->clients[$client->nickname] += 2 : $this->clients[$client->nickname] = 2);
            }
        }
    }
}
<?php

namespace PexelTS\Reports;

use TeamSpeakLogs\ReportController;
use TeamSpeakLogs\View;

class MostOnlineUIDReport extends ReportController
{
    private $clients = [];
    private $clientsProfiles = [];

    /**
     * Returns view that is generated by this report controller.
     *
     * @return View resulting view
     */
    public function generate()
    {
        arsort($this->clients);

        return View::make('report.mostonlineuid',
            ['clients' => $this->clients, 'clientsProfiles' => $this->clientsProfiles]);
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
                (isset($this->clients[$client->uid]) ? $this->clients[$client->uid] += 2 : $this->clients[$client->uid] = 2);
                if (!isset($this->clientsProfiles[$client->uid])) {
                    $this->clientsProfiles[$client->uid] = $client;
                }
            }
        }
    }
}
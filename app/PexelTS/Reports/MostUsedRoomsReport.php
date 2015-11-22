<?php

namespace PexelTS\Reports;

use TeamSpeakLogs\ReportController;
use TeamSpeakLogs\View;

class MostUsedRoomsReport extends ReportController
{

    private $rooms = [];
    private $roomNames = [];

    /**
     * Returns view that is generated by this report controller.
     *
     * @return View resulting view
     */
    public function generate()
    {
        arsort($this->rooms);

        return View::make('report.mostusedrooms', ['rooms' => $this->rooms, 'roomNames' => $this->roomNames]);
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
            if (!isset($this->rooms[$channel->id])) {
                $this->rooms[$channel->id] = 0;
            }

            if (!isset($this->roomNames[$channel->id])) {
                $this->roomNames[$channel->id] = $channel->name;
            }

            if (count($channel->clients) > 0) {
                $this->rooms[$channel->id]++;
            }
        }
    }
}
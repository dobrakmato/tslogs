<?php
// Prepare PHP with some variables.
error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Bratislava');
set_time_limit(0);
ini_set('memory_limit', '1024M');

// Include composer.
require_once("vendor/autoload.php");

use PexelTS\CustomDataProvider;
use PexelTS\Reports\LastUsedReportController;
use PexelTS\Reports\MostOnlineNicknameReportController;
use PexelTS\Reports\MostOnlineUIDReportController;
use PexelTS\Reports\MostUsedRoomsClientsReportController;
use PexelTS\Reports\MostUsedRoomsReportController;

// Create new instance of application and run it!
$app = new \TeamSpeakLogs\Application();

$app->setPublicRoot('http://beta.mtkn.eu/mato/tslogs2/public/');
$app->setDataProvider(new CustomDataProvider('/home/mato/tsbot/ts_logs/'));
$app->setOutputDirectory(__DIR__ . '/public');

$app->addReport('Posledné použitie miestností', 'room/lastused', LastUsedReportController::class);
$app->addReport('Najdlhšie online nickname', 'nick/mostonline', MostOnlineNicknameReportController::class);
$app->addReport('Najdlhšie online užívatelia', 'user/mostonline', MostOnlineUIDReportController::class);
$app->addReport('Najviac používané miestnosti', 'room/mostused', MostUsedRoomsReportController::class);
$app->addReport('Najviac používané miestnosti užívateľmi', 'room/mostonline', MostUsedRoomsClientsReportController::class);

$app->run();
<?php

namespace TeamSpeakLogs;

use TeamSpeakLogs\Exceptions\NoDataProviderException;
use TeamSpeakLogs\Logging\Logger;

class Application
{
    /**
     * Array of report controllers.
     *
     * @var ReportController[]
     */
    private $reports;

    /**
     * Data provider for report controllers.
     *
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * Output directory used as HTML root.
     *
     * @var string
     */
    private $outputDirectory;

    /**
     * Public access URL.
     *
     * @var string
     */
    private $publicRoot = '';

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $GLOBALS['app'] = $this;

        $this->reports = [];
        $this->outputDirectory = __DIR__ . '/html';

        // Load helper functions.
        require_once('functions.php');
    }

    public function run()
    {
        Logger::info('Application started!');
        $this->checkConfiguration();

        Logger::info('Processing data sequentially using ' . count($this->reports) . ' report controllers!');

        $current = null;

        // Process data.
        for ($processed = 0; $this->dataProvider->hasData(); $processed++) {
            $current = $this->dataProvider->nextData();

            if ($current == null) {
                continue;
            }

            foreach ($this->reports as $report) {
                $report->process($current);
            }

            if (($processed % 2000) == 0 && $processed != 0) {
                Logger::info('Processed ' . $processed . ' files!');
            }
        }

        // Generate HTMLs.
        foreach ($this->reports as $report) {
            Logger::info('Rendering HTML for ' . $report->getName() . '...');
            $view = $report->generate();

            if ($view == null) {
                Logger::warn('Report controller ' . $report->getName() . ' returned null!');
                continue;
            }

            $view->addArgument('report', $report);
            $view->addArgument('reports', $this->reports);
            $view->addArgument('urlRoot', $this->publicRoot);

            $html = $view->render();
            $file = $this->outputDirectory . '/' . $report->getSlug() . '.html';
            $dir = substr($file, 0, strripos($file, '/') + 1);

            $this->createPath($dir);
            file_put_contents($file, $html);
        }

        Logger::info('Rendering HTML for index...');

        $view = View::make('index', ['reports' => $this->reports, 'urlRoot' => $this->publicRoot]);
        $html = $view->render();
        file_put_contents($this->outputDirectory . '/index.html', $html);

        Logger::info('Everything done!');
    }

    private function createPath($path)
    {
        if (is_dir($path)) {
            return true;
        }
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
        $return = $this->createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

    private function checkConfiguration()
    {
        if ($this->dataProvider == null) {
            throw new NoDataProviderException("No data provider was set!");
        }
    }

    /**
     * Adds specified class as report controller to this application.
     *
     * @param string $name Human readable name of this report.
     * @param string $slug Slug used to generate URLs.
     * @param string $class Class of report to use.
     */
    public function addReport($name, $slug, $class)
    {
        /** @var \ReflectionClass $clazz */
        $clazz = new \ReflectionClass($class);
        /** @var ReportController $instance */
        $instance = $clazz->newInstance();
        $instance->setName($name);
        $instance->setSlug($slug);
        $this->reports[] = $instance;
    }

    /**
     * Sets HTML output directory to specified one.
     *
     * @param string $outputDir html output directory
     */
    public function setOutputDirectory($outputDir)
    {
        $this->outputDirectory = $outputDir;
    }

    /**
     * Sets data provider for this application.
     *
     * @param DataProvider $dataProvider
     */
    public function setDataProvider(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Sets public root of generated files. This is used to correctly
     * generate a href links.
     *
     * @param string $publicRoot public root
     */
    public function setPublicRoot($publicRoot)
    {
        $this->publicRoot = $publicRoot;
    }

    public function getPublicRoot()
    {
        return $this->publicRoot;
    }

    public function getDataProvider()
    {
        return $this->dataProvider;
    }

    public function getOutputDirectory()
    {
        return $this->outputDirectory;
    }

    public function getReports()
    {
        return $this->reports;
    }
}
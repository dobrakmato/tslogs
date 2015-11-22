<?php

namespace PexelTS;

use RuntimeException;
use TeamSpeakLogs\DataProvider;
use TeamSpeakLogs\Logging\Logger;

class CustomDataProvider implements DataProvider
{
    /**
     * Root of our data.
     *
     * @var string
     */
    private $dataRoot;

    private $files;

    /**
     * CustomDataProvider constructor.
     * @param string $dataRoot root folder of our data
     */
    public function __construct($dataRoot)
    {
        $this->dataRoot = $dataRoot;
        $this->files = array_reverse(glob($this->dataRoot . '/**/*.json'));

        Logger::info('Found ' . count($this->files) . ' files...');
    }

    /**
     * Returns all data used to generate all reports.
     *
     * @deprecated has high RAM usage, use hasData() and nextData() methods
     * @return mixed data
     */
    function provideData()
    {
        throw new RuntimeException('Unsupported operation!');
    }

    /**
     * Returns whether this provider has more data or not.
     *
     * @return boolean true if has data, false otherwise
     */
    function hasData()
    {
        return count($this->files) != 0;
    }

    /**
     * Provides next one data.
     *
     * @return mixed data
     */
    function nextData()
    {
        $file = array_pop($this->files);
        $contents = file_get_contents($file);
        $data = json_decode($contents);

        if ($data == null) {
            Logger::error('Decoded json (' . $file . ') is NULL!');
            return null;
        }

        if (!isset($data->filemtime)) {
            $time = filemtime($file);
            $data->filemtime = $time === false ? 0 : $time;
        }

        return $data;
    }
}
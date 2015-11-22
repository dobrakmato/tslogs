<?php

namespace TeamSpeakLogs;

interface DataProvider
{
    /**
     * Returns all data used to generate all reports.
     *
     * @deprecated has high RAM usage, use hasData() and nextData() methods
     * @return mixed data
     */
    function provideData();

    /**
     * Returns whether this provider has more data or not.
     *
     * @return boolean true if has data, false otherwise
     */
    function hasData();

    /**
     * Provides next one data.
     *
     * @return mixed data
     */
    function nextData();
}
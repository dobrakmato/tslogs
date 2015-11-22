<?php
if (!function_exists('href')) {
    /**
     * Returns absolute URL path.
     *
     * @param string $url relative
     * @return string absolute
     */
    function href($url)
    {
        return $GLOBALS['app']->getPublicRoot() . $url;
    }
}

if (!function_exists('formatTime')) {
    /**
     * Formats time.
     *
     * @param $minutes
     * @return string
     */
    function formatTime($minutes)
    {
        $hrs = floor($minutes / 60);
        $mns = $minutes % 60;
        $mnsf = $mns < 10 ? "0" . $mns : $mns;
        return $hrs < 10 ? "0" . $hrs . ":" . $mnsf : $hrs . ":" . $mnsf;
    }
}

if (!function_exists('part')) {
    /**
     * Inserts partial template.
     *
     * @param $partname
     */
    function part($partname)
    {
        foreach ($GLOBALS['view_args'] as $name => $value) {
            ${$name} = $value;
        }
        include(__DIR__ . '/../../resources/views/parts/' . str_replace('.', '/', $partname) . '.php');
    }
}

if (!function_exists('cleanoutput')) {
    /**
     * Cleans output from attacks.
     *
     * @param $output
     * @return mixed
     */
    function cleanoutput($output)
    {
        $output = str_replace('<', '&gt;', $output);
        $output = str_replace('>', '&lt;', $output);
        $output = str_replace('(', '', $output);
        $output = str_replace(')', '', $output);
        $output = str_replace('{', '', $output);
        $output = str_replace('}', '', $output);
        return $output;
    }
}
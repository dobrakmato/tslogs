<?php

namespace TeamSpeakLogs;

/**
 * Class View represents minimal view-like implementation.
 * @package TeamSpeakLogs
 */
class View
{
    /**
     * Arguments provided to rendered template.
     *
     * @var array
     */
    private $args;

    /**
     * File of rendered template.
     *
     * @var string
     */
    private $file;

    /**
     * View constructor.
     * @param string $name name
     * @param array $args args
     */
    public function __construct($name, $args)
    {
        $this->file = __DIR__ . '/../../resources/views/' . str_replace('.', '/', $name) . '.php';
        $this->args = $args;
    }

    /**
     * Creates a new View from file with specified name and uses templating engine
     * to process it with specified args.
     *
     * @param string $name Name of the view
     * @param array $args Arguments
     * @returns View a new View
     */
    static function make($name, $args = array())
    {
        return new View($name, $args);
    }

    /**
     * Adds specified argument to this view.
     *
     * @param string $name argument name
     * @param mixed $arg argument value
     */
    public function addArgument($name, $arg)
    {
        $this->args[$name] = $arg;
    }

    /**
     * Renders this view to HTML.
     *
     * @return string rendered html
     * @throws \Exception
     */
    public function render()
    {
        $contents = file_get_contents($this->file);

        if ($contents == false) {
            throw new \Exception("Can't get contents of view file!");
        }

        // Store args in global.
        $GLOBALS['view_args'] = $this->args;

        foreach ($this->args as $name => $value) {
            ${$name} = $value;
        }

        ob_start();
        eval('?>' . $contents . '<?php');
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }
}
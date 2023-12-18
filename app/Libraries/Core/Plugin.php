<?php

namespace App\Libraries\Core;

abstract class Plugin
{
    private array $plugins = [];

    private array $use = [];

    public function __construct()
    {
        $this->plugins();
    }

    abstract protected function plugins();

    /**
     * get plugin HTML
     */
    public function get(): array
    {
        $separator = env_is('production') ? '' : PHP_EOL;
        $heads = array();
        $foots = array();

        foreach ($this->use as $use) {
            $plugin = $this->plugins[$use];

            foreach ($plugin as $plug) {
                $url = $plug['url'];
                if ($plug['position'] == 'head') {
                    $heads[] = $this->_tag($url, $plug['type']);
                }
                if ($plug['position'] == 'foot') {
                    $foots[] = $this->_tag($url, $plug['type']);
                }
            }
        }
        return array(
            'head' => implode($separator, $heads),
            'foot' => implode($separator, $foots)
        );
    }

    /**
     * set used plugins
     * @param string|array $keys plugin keys
     * @return set
     */
    public function set($keys)
    {
        $use = array();

        if (is_string($keys)) $use = explode('|', $keys);
        if (is_array($keys)) $use = $keys;

        if (!empty($use)) {
            $pluginkeys = array_keys($this->plugins);
            foreach ($use as $us) if (
                in_array($us, $pluginkeys) &&
                !in_array($us, $this->use)
            ) {
                $this->use[] = $us;
            }
        }
    }

    /**
     * setup used plugins
     * @param string $key plugin group key
     * @param array $plugins plugin array [url, css/js), head/foot)]
     * @return set
     */
    protected function plugin(string $key, array $plugins)
    {
        $values = array();
        foreach ($plugins as $plug) {
            $truevalue = true;
            $pluginval = array(
                'url'      => $plug[0] ?? 0,
                'type'     => $plug[1] ?? 'false',
                'position' => $plug[2] ?? null
            );
            if (!is_string($pluginval['url']))
                $truevalue = false;
            if (
                !is_string($pluginval['type']) ||
                !in_array($pluginval['type'], ['css', 'js'])
            )   $truevalue = false;
            if (
                !is_string($pluginval['position']) ||
                !in_array($pluginval['position'], ['head', 'foot'])
            )   $truevalue = false;

            if ($truevalue) $values[] = $pluginval;
        }
        if (!empty($values)) $this->plugins[$key] = $values;
    }

    private function _tag(string $url, string $tipe): string
    {
        $html = array(
            'css' => '<link rel="stylesheet" href="' . $url . '">',
            'js'  => '<script src="' . $url . '"></script>'
        );
        return $html[$tipe];
    }
}

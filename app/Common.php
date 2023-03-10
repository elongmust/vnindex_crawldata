<?php

use Config\Services;
use Config\View;

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter4.github.io/CodeIgniter4/
 */

if (!function_exists('page')) {
    function view(string $name, array $data = [], array $options = []): string
    {
        /**
         * @var CodeIgniter\View\View $renderer
         */
        $renderer = Services::renderer();

        $saveData = config(View::class)->saveData;

        if (array_key_exists('saveData', $options)) {
            $saveData = (bool) $options['saveData'];
            unset($options['saveData']);
        }

        $data_content =  $renderer->setData($data, 'raw')->render($name, $options, $saveData); // js will loading 2 times
        $page_contents = $renderer->getPageContent($data_content);
        return $page_contents;
    }
}

if (!function_exists('useTemplate')) {
    function useTemplate(string $templateName)
    {
        $renderer = Services::renderer();
        return $renderer->useTemplate($templateName);
    }
}

if (!function_exists('setBreadcrumb')) {
    function setBreadcrumb(array $aBreadcrumb)
    {
        $GLOBALS['sBreadcrumb'] = '<li class="breadcrumb-item"><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a></li>';
        end($aBreadcrumb);         // move the internal pointer to the end of the array
        $kk = key($aBreadcrumb); 
        foreach ($aBreadcrumb as $key => $val) {
            if($key == $kk) {
                $GLOBALS['sBreadcrumb'] .= '<li class="breadcrumb-item active" aria-current="page">' . $val . ' </li>';
            }else {
                $GLOBALS['sBreadcrumb'] .= '<li class="breadcrumb-item "><a href="'.base_url().'/' . $key . '"> ' . $val . '</a></li>';
            }
            
        }
    }
}


if (!function_exists('loadCss')) {
    function loadCss(array $aCss)
    {
        $renderer = Services::renderer();
        return $renderer->setCss($aCss);
    }
}

if (!function_exists('loadJs')) {
    function loadJs(array $aJs)
    {
        $renderer = Services::renderer();
        return $renderer->setJs($aJs);
    }
}


if (!function_exists('setTitle')) {
    function setTitle(string $title)
    {
        $GLOBALS['title'] = $title;
    }
}


if (!function_exists('setMeta')) {
    function setMeta(array $aMeta)
    {
        $GLOBALS['meta'] = '';
        foreach ($aMeta as $meta) {
            $GLOBALS['meta'] .= '<meta ' . $meta . ' />';
        }
    }
}


if (!function_exists('vd')) {
    function vd($var = false, $trace = 1, $showHtml = false, $showFrom = true)
    {
        if ($showFrom) {
            $calledFrom = debug_backtrace();
            for ($i = 0; $i < $trace; $i++) {
                if (!isset($calledFrom[$i]['file'])) {
                    break;
                }
                echo substr($calledFrom[$i]['file'], 1);
                echo ' (line <strong>' . $calledFrom[$i]['line'] . '</strong>)';
                echo "<br />";
            }
        }
        echo "<pre class=\"cake-debug\">\n";

        $var = var_dump($var);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo $var . "\n</pre>\n";
    }
    function vdd($var = false, $trace = 1, $showHtml = false, $showFrom = true)
    {
        if ($showFrom) {
            $calledFrom = debug_backtrace();
            for ($i = 0; $i < $trace; $i++) {
                if (!isset($calledFrom[$i]['file'])) {
                    break;
                }
                echo substr($calledFrom[$i]['file'], 1);
                echo ' (line <strong>' . $calledFrom[$i]['line'] . '</strong>)';
                echo "<br />";
            }
        }
        echo "<pre class=\"cake-debug\">\n";

        $var = var_dump($var);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo $var . "\n</pre>\n";
        die;
    }
}

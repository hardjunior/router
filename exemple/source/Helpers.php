<?php

if (!function_exists('dd')) {    
    /**
     * dd
     *
     * @param  mixed $var
     * @param  mixed $trace
     * @return void
     */
    function dd($var,$trace = "yes")
    {
        // try {
        //     throw new Exception("Some error message");
        // } catch (Exception $e) { $trace = $e->getTrace(); }

        $traced = new \ErrorException( "", 0, E_WARNING );

        @header('Content-Type: text/html; charset=iso-8859-1', true);
        echo "<pre style='margin:100px;color:red; border:1px solid orange; padding:10px; border-radius:10px;'>";
        echo "Tipo: ";
        print_r($var);
        echo "</pre>";
        if ($trace = "yes")
        {
            echo "<pre style='margin:100px;color:black; border:1px solid green; padding:10px; border-radius:10px;'>";
                print_r($traced);   
            echo "</pre>";
        }
        exit;
    }
}

/**
 * @param string|null $uri
 * @return string
 */
 
if (!function_exists('url')) {        
    /**
     * url
     *
     * @param  mixed $uri
     * @return string
     */
    function url(string $uri = null): string
    {
        if (defined("ROOT"))
        {
            if ($uri) {
                return ROOT . DIRECTORY_SEPARATOR . "{$uri}";
            }

            return ROOT;
        }
    }
}

if (!function_exists('encurtar')) {        
    /**
     * encurtar
     *
     * @param  mixed $var
     * @return void
     */
    function encurtar(String $var)
    {
        $t = explode(" ", $var);
        return ucfirst($t[0]) . " " . ucfirst($t[count($t) - 1]);
    }
}
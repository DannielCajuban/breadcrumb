<?php

namespace Breadcrumbs\BreadcrumbsBundle\Resources\views\twig;

class AppExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('breadcrumbs', array($this, 'breadcrumbs')),
        );
    }


    public function breadcrumbs()
    {

        $separator = ' &raquo; ';
        $fullPath = $this->full_path();

        $single_path = array('sample');
        $multi_path = array('sample/sample2','blend/blend2/blending');

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

//        REPLACE $PATH
        if($single_path != null){
            foreach($single_path as $key => $rout){
                foreach ($crumbs as $key => $crumb) {
                    if($rout == $crumb){
                        array_shift($crumbs);
                        $sin = true;
                    }
                }
            }

        }
        if($multi_path != null) {
            foreach ($multi_path as $key => $routs) {

                    $root = explode("/",$routs);
                    $maxRout = count($root);

                    foreach($root as $key2 => $rout){
                        for($i = 0; $i < $maxRout; $i++){

                            if(array_key_exists($i,$crumbs))
                            {
                                if($rout == $crumbs[$i]){
                                    array_shift($crumbs);

                                }
                            }
                        }
                    }
            }

        }

        $last = end($crumbs);
        foreach($crumbs as $key => $crumb){
            switch($key){
                case '0':
                    echo "";
                    break;
                default:
                    if($crumb != $last){
                        $label =  ucfirst(str_replace(array(".php","_"),array(""," "),$crumb)  .  $separator);
                        echo "<a href = $fullPath>$label</a>";
                        break;
                    }
                    else{
                        $label =  ucfirst(str_replace(array(".php","_"),array(""," "),$crumb)  .  $separator);
                        echo $label;
                        break;
                    }
            }
        }
    }

    public function full_path()
    {
        $s = &$_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTP'] == 'on') ? true:false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
        $segments = explode('?', $uri, 2);
        $url = $segments[0];
        return $url;
    }



    public function getName()
    {
        return 'app_extension';
    }
}
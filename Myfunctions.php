<?php
// to receive image from url
    function t() {
        $url = 'https://avatars1.githubusercontent.com/u/12970308?v=4';
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        echo $name;
        dd(Storage::put($name, $contents));        
    }
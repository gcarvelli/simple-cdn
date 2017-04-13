<?php
    require 'vendor/autoload.php';

    $config = new SimpleCDN\Config('config.json');
    $cache = new SimpleCDN\ImageCache($config);

    $urlParts = parse_url($_SERVER['REQUEST_URI']);

    $imagePath = null;
    if (array_key_exists($_GET, 'h') and array_key_exists($_GET, 'w')) {
        $imagePath = $cache->getImage($urlParts['path'], $_GET['h'], $_GET['w']);
    } else {
        $imagePath = $cache->getImage($urlParts['path']);
    }

    if ($imagePath == null) {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        exit;
    }

    // send the right headers
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($imagePath));

    // dump the picture and stop the script
    $fp = fopen($imagePath, 'rb');
    fpassthru($fp);

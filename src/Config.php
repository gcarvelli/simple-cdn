<?php
    namespace SimpleCDN;

    require 'vendor/autoload.php';

    class Config {
        public $imageDir;
        public $cacheDir;

        public function __construct($filename) {
            if (!is_file($filename)) {
                throw new Exception("simple-cdn: config $filename is missing.");
            }

            $config = json_decode(file_get_contents($filename), true);

            if (!array_key_exists('image-dir', $config)) {
                error_log('simple-cdn: key "image-dir" not found in config, defaulting to images/.');
                $config['image-dir'] = realpath('../images/');
            }
            if (!array_key_exists('cache-dir', $config)) {
                error_log('simple-cdn: key "cache-dir" not found in config, defaulting to cache/.');
                $config['cache-dir'] = realpath('../cache/');
            }

            $this->imageDir = join(DIRECTORY_SEPARATOR, array(getcwd(), $config['image-dir']));
            $this->cacheDir = join(DIRECTORY_SEPARATOR, array(getcwd(), $config['cache-dir']));
        }
    }
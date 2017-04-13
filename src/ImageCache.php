<?php
    namespace SimpleCDN;

    require 'vendor/autoload.php';
    
    class ImageCache {

        private $config;

        public function __construct(Config $config) {
            $this->config = $config;
        }

        public function getImage($imagePath, $height = false, $width = false) {
            if ($height !== false || $width !== false) {

            } else {
                $realpath = $this->config->imageDir . $imagePath;
                if (is_file($realpath)) {
                    return $realpath;
                }
            }
            return null;
        }

        public function clearCache() {

        }

    }
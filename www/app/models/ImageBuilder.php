<?php

    namespace app\models;

    class ImageBuilder {

        private string $default;
        /**
         * @var string[]
         */
        private array $scaled;

        /**
         * ImageBuilder constructor.
         * @param string $default
         * @param string[] $scaled
         */
        private function __construct(string $default, array $scaled) {
            $this->default = $default;
            $this->scaled = $scaled;
        }

        public function with(float $scale, string $url): ImageBuilder {
            $this->scaled["{$scale}x"] = $url;
            return $this;
        }

        public function build(): MultiImage {
            return new MultiImage($this->default, $this->scaled);
        }

        static function from(string $url): ImageBuilder {

        }
    }
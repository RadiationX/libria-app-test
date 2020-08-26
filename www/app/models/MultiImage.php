<?php


    namespace app\models;


    class MultiImage {

        static function from(string $url): MultiImage {
            return new MultiImage($url);
        }

        private string $default;
        /**
         * @var string[]
         */
        private array $scaled;

        /**
         * MultiImage constructor.
         * @param string $default
         * @param string[] $scaled
         */
        public function __construct(string $default, array $scaled = []) {
            $this->default = $default;
            $this->scaled = $scaled;
        }

        public function with(float $scale, string $url): MultiImage {
            $this->scaled["{$scale}x"] = $url;
            return $this;
        }

        /**
         * @return string
         */
        public function getDefault(): string {
            return $this->default;
        }

        /**
         * @return string[]
         */
        public function getScaled(): array {
            return $this->scaled;
        }
    }


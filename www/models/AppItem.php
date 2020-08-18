<?php


    class AppItem {
        private $link = "";
        private $type = TYPE_UNKNOWN;
        private $image = "";
        private $icon = "";
        private $name = "";
        private $platforms = "";

        /**
         * AppItem constructor.
         * @param string $link
         * @param string $type
         * @param string $image
         * @param string $icon
         * @param string $name
         * @param string $platforms
         */
        public function __construct($link, $type, $image, $icon, $name, $platforms) {
            $this->link = $link;
            $this->type = $type;
            $this->image = $image;
            $this->icon = $icon;
            $this->name = $name;
            $this->platforms = $platforms;
        }

        /**
         * @return string
         */
        public function getLink() {
            return $this->link;
        }

        /**
         * @return string
         */
        public function getType() {
            return $this->type;
        }

        /**
         * @return string
         */
        public function getImage() {
            return $this->image;
        }

        /**
         * @return string
         */
        public function getIcon() {
            return $this->icon;
        }

        /**
         * @return string
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return string
         */
        public function getPlatforms() {
            return $this->platforms;
        }
    }

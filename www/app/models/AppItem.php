<?php

    namespace app\models;

    class AppItem {
        private string $id;
        private AppTarget $target;
        private string $link;
        private string $image;
        private string $icon;
        private string $name;
        private string $platforms;

        /**
         * AppItem constructor.
         * @param string $id
         * @param AppTarget $target
         * @param string $link
         * @param string $image
         * @param string $icon
         * @param string $name
         * @param string $platforms
         */
        public function __construct(
            $id,
            $target,
            $link,
            $image,
            $icon,
            $name,
            $platforms
        ) {
            $this->id = $id;
            $this->target = $target;
            $this->link = $link;
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
        public function getId() {
            return $this->id;
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

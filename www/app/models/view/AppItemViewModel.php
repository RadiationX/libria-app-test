<?php
    declare(strict_types=1);

    namespace app\models\view;

    class AppItemViewModel {
        private string $id;
        private string $link;
        private string $image;
        private string $icon;
        private string $name;
        private string $platform;

        /**
         * AppItemViewModel constructor.
         * @param string $id
         * @param string $link
         * @param string $image
         * @param string $icon
         * @param string $name
         * @param string $platform
         */
        public function __construct(
            string $id,
            string $link,
            string $image,
            string $icon,
            string $name,
            string $platform
        ) {
            $this->id = $id;
            $this->link = $link;
            $this->image = $image;
            $this->icon = $icon;
            $this->name = $name;
            $this->platform = $platform;
        }

        /**
         * @return string
         */
        public
        function getId(): string {
            return $this->id;
        }

        /**
         * @return string
         */
        public
        function getLink(): string {
            return $this->link;
        }

        /**
         * @return string
         */
        public
        function getImage(): string {
            return $this->image;
        }

        /**
         * @return string
         */
        public
        function getIcon(): string {
            return $this->icon;
        }

        /**
         * @return string
         */
        public
        function getName(): string {
            return $this->name;
        }

        /**
         * @return string
         */
        public function getPlatform(): string {
            return $this->platform;
        }
    }

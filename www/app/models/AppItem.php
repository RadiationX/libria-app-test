<?php
    declare(strict_types=1);

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

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getLink(): string {
            return $this->link;
        }

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getId(): string {
            return $this->id;
        }

        /**
         * @return AppTarget
         */
        public function getTarget(): AppTarget {
            return $this->target;
        }

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getImage(): string {
            return $this->image;
        }

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getIcon(): string {
            return $this->icon;
        }

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getName(): string {
            return $this->name;
        }

        /** @noinspection PhpUnused
         *  used in app-item-partial.mustache
         */
        public function getPlatforms(): string {
            return $this->platforms;
        }
    }

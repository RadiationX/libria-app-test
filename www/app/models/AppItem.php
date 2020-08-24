<?php
    declare(strict_types=1);

    namespace app\models;

    class AppItem {
        private string $id;
        private AppTarget $target;
        private string $image;
        private string $icon;

        /**
         * AppItem constructor.
         * @param string $id
         * @param AppTarget $target
         * @param string $image
         * @param string $icon
         */
        public function __construct(
            $id,
            $target,
            $image,
            $icon
        ) {
            $this->id = $id;
            $this->target = $target;
            $this->image = $image;
            $this->icon = $icon;
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
    }

<?php
    declare(strict_types=1);

    namespace app\models;

    class AppItem {
        private string $id;
        private AppTarget $target;
        private string $image;
        private string $name;
        private ?string $desc;

        /**
         * AppItem constructor.
         * @param string $id
         * @param AppTarget $target
         * @param string $image
         * @param string $name
         * @param ?string $desc
         */
        public function __construct(
            string $id,
            AppTarget $target,
            string $image,
            string $name,
            ?string $desc = null
        ) {
            $this->id = $id;
            $this->target = $target;
            $this->image = $image;
            $this->name = $name;
            $this->desc = $desc;
        }

        /**
         * @return string
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

        /**
         * @return string
         */
        public function getImage(): string {
            return $this->image;
        }

        /**
         * @return string
         */
        public function getName(): string {
            return $this->name;
        }

        /**
         * @return ?string
         */
        public function getDesc(): ?string {
            return $this->desc;
        }
    }

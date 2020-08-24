<?php
    declare(strict_types=1);

    namespace app\models\detail;


    class AppSource {

        private string $title;
        private string $type;
        private string $link;
        private ?string $service;

        /**
         * AppSource constructor.
         * @param string $title
         * @param string $type
         * @param string $link
         * @param string|null $service
         */
        public function __construct(
            string $title,
            string $type,
            string $link,
            ?string $service
        ) {
            $this->title = $title;
            $this->type = $type;
            $this->link = $link;
            $this->service = $service;
        }

        /**
         * @return string
         */
        public function getTitle(): string {
            return $this->title;
        }

        /**
         * @return string
         */
        public function getType(): string {
            return $this->type;
        }

        /**
         * @return string
         */
        public function getLink(): string {
            return $this->link;
        }

        /**
         * @return string|null
         */
        public function getService(): ?string {
            return $this->service;
        }
    }
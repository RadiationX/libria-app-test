<?php
    declare(strict_types=1);

    namespace app\models\detail;


    class AppSource {

        private string $title;
        private string $link;

        /**
         * AppSource constructor.
         * @param string $title
         * @param string $link
         */
        public function __construct(
            string $title,
            string $link
        ) {
            $this->title = $title;
            $this->link = $link;
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
        public function getLink(): string {
            return $this->link;
        }
    }
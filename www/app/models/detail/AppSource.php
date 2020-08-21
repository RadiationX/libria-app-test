<?php


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

    }
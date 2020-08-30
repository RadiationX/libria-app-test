<?php


    namespace app\models\view\head;


    class PageHeadViewModel {

        private string $title;
        private string $description;
        private OpenGraphViewModel $openGraph;

        /**
         * PageHeadViewModel constructor.
         * @param string $title
         * @param string $description
         * @param OpenGraphViewModel $openGraph
         */
        public function __construct(
            string $title,
            string $description,
            OpenGraphViewModel $openGraph
        ) {
            $this->title = $title;
            $this->description = $description;
            $this->openGraph = $openGraph;
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
        public function getDescription(): string {
            return $this->description;
        }

        /**
         * @return OpenGraphViewModel
         */
        public function getOpenGraph(): OpenGraphViewModel {
            return $this->openGraph;
        }
    }
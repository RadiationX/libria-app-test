<?php


    namespace app\models\head;


    class PageHeadData {

        private string $title;
        private string $description;
        private OpenGraph $openGraph;

        /**
         * PageHeadData constructor.
         */
        public function __construct() {
            $this->openGraph = new OpenGraph();
            $this->setTitle("Наши приложения");
            $this->setDescription("Приложения для просмотра аниме на AniLibria.tv");
            $this->openGraph
                ->setSiteName("AniLibria.app")
                ->setImage("");
        }

        /**
         * @return string
         */
        public function getTitle(): string {
            return $this->title;
        }

        /**
         * @param string $title
         * @return PageHeadData
         */
        public function setTitle(string $title): PageHeadData {
            $this->title = $title;
            $this->openGraph->setTitle($title);
            return $this;
        }

        /**
         * @return string
         */
        public function getDescription(): string {
            return $this->description;
        }

        /**
         * @param string $description
         * @return PageHeadData
         */
        public function setDescription(string $description): PageHeadData {
            $this->description = $description;
            $this->openGraph->setDescription($description);
            return $this;
        }

        /**
         * @return OpenGraph
         */
        public function getOpenGraph(): OpenGraph {
            return $this->openGraph;
        }
    }
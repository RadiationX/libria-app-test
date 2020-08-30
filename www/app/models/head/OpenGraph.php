<?php


    namespace app\models\head;


    class OpenGraph {

        private ?string $title = null;
        private ?string $description = null;
        private ?string $siteName = null;
        private ?string $image = null;
        private ?string $url = null;

        /**
         * @return string|null
         */
        public function getTitle(): ?string {
            return $this->title;
        }

        /**
         * @param string|null $title
         * @return OpenGraph
         */
        public function setTitle(?string $title): OpenGraph {
            $this->title = $title;
            return $this;
        }

        /**
         * @return string|null
         */
        public function getDescription(): ?string {
            return $this->description;
        }

        /**
         * @param string|null $description
         * @return OpenGraph
         */
        public function setDescription(?string $description): OpenGraph {
            $this->description = $description;
            return $this;
        }

        /**
         * @return string|null
         */
        public function getSiteName(): ?string {
            return $this->siteName;
        }

        /**
         * @param string|null $siteName
         * @return OpenGraph
         */
        public function setSiteName(?string $siteName): OpenGraph {
            $this->siteName = $siteName;
            return $this;
        }

        /**
         * @return string|null
         */
        public function getImage(): ?string {
            return $this->image;
        }

        /**
         * @param string|null $image
         * @return OpenGraph
         */
        public function setImage(?string $image): OpenGraph {
            $this->image = $image;
            return $this;
        }

        /**
         * @return string|null
         */
        public function getUrl(): ?string {
            return $this->url;
        }

        /**
         * @param string|null $url
         * @return OpenGraph
         */
        public function setUrl(?string $url): OpenGraph {
            $this->url = $url;
            return $this;
        }

    }
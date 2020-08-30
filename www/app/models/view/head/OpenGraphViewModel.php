<?php


    namespace app\models\view\head;


    class OpenGraphViewModel {

        private ?string $title = null;
        private ?string $description = null;
        private ?string $siteName = null;
        private ?string $image = null;
        private ?string $url = null;

        /**
         * OpenGraphViewModel constructor.
         * @param string|null $title
         * @param string|null $description
         * @param string|null $siteName
         * @param string|null $image
         * @param string|null $url
         */
        public function __construct(
            ?string $title,
            ?string $description,
            ?string $siteName,
            ?string $image,
            ?string $url
        ) {
            $this->title = $title;
            $this->description = $description;
            $this->siteName = $siteName;
            $this->image = $image;
            $this->url = $url;
        }

        /**
         * @return string|null
         */
        public function getTitle(): ?string {
            return $this->title;
        }

        /**
         * @return string|null
         */
        public function getDescription(): ?string {
            return $this->description;
        }

        /**
         * @return string|null
         */
        public function getSiteName(): ?string {
            return $this->siteName;
        }

        /**
         * @return string|null
         */
        public function getImage(): ?string {
            return $this->image;
        }

        /**
         * @return string|null
         */
        public function getUrl(): ?string {
            return $this->url;
        }
    }
<?php
    declare(strict_types=1);

    namespace app\models\detail;


    class AppSource {

        const TYPE_GITHUB = "github";

        private string $title;
        private string $link;
        private ?string $type;

        /**
         * AppSource constructor.
         * @param string $title
         * @param string $link
         * @param ?string $type
         */
        public function __construct(
            string $title,
            string $link,
            ?string $type = null
        ) {
            $this->title = $title;
            $this->link = $link;
            $this->type = $type;
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

        /**
         * @return string|null
         */
        public function getType(): ?string {
            return $this->type;
        }
    }
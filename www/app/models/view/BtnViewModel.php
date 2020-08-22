<?php


    namespace app\models\view;


    class BtnViewModel {

        public const CLASS_FILLED = "filled";
        public const CLASS_SMALL = "small";
        public const CLASS_SUB = "sub";

        private string $link;
        private string $text;
        private string $icon;
        /**
         * @var string[]
         */
        private array $classes;

        /**
         * BtnViewModel constructor.
         * @param string $link
         * @param string $text
         * @param string $icon
         * @param string[] $classes
         */
        public function __construct(
            string $link,
            string $text,
            string $icon,
            array $classes
        ) {
            $this->link = $link;
            $this->text = $text;
            $this->icon = $icon;
            $this->classes = $classes;
        }

        /**
         * @return string
         */
        public function getLink(): string {
            return $this->link;
        }

        /**
         * @return string
         */
        public function getText(): string {
            return $this->text;
        }

        /**
         * @return string
         */
        public function getIcon(): string {
            return $this->icon;
        }

        /**
         * @return string
         */
        public function getClasses(): string {
            return join(" ", $this->classes);
        }
    }
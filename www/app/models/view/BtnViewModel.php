<?php


    namespace app\models\view;


    class BtnViewModel {

        public const CLASS_FILLED = "filled";
        public const CLASS_SMALL = "small";
        public const CLASS_SUB = "sub";

        private string $link;
        private string $text;
        private ?string $icon;
        /**
         * @var string[]
         */
        private array $classes;
        private bool $openNewTab = false;

        /**
         * BtnViewModel constructor.
         * @param string $link
         * @param string $text
         * @param ?string $icon
         * @param string[] $classes
         */
        public function __construct(
            string $link,
            string $text,
            ?string $icon,
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

        public function getText(): string {
            return $this->text;
        }

        public function getIcon(): ?string {
            return $this->icon;
        }

        public function getClasses(): string {
            return join(" ", $this->classes);
        }

        public function isOpenNewTab(): bool {
            return $this->openNewTab;
        }

        public function setOpenNewTab(bool $openNewTab): BtnViewModel {
            $this->openNewTab = $openNewTab;
            return $this;
        }
    }
<?php


    namespace app\models\view\detail;


    use app\models\view\BtnViewModel;

    class AppModViewModel {

        public const CLASS_HIDDEN = "hidden";

        private BtnViewModel $primaryBtn;
        /**
         * @var BtnViewModel[]
         */
        private array $otherBtns;
        private array $classes;

        /**
         * AppModViewModel constructor.
         * @param BtnViewModel $primaryBtn
         * @param BtnViewModel[] $otherBtns
         * @param string[] $classes
         */
        public function __construct(
            BtnViewModel $primaryBtn,
            array $otherBtns,
            array $classes
        ) {
            $this->primaryBtn = $primaryBtn;
            $this->otherBtns = $otherBtns;
            $this->classes = $classes;
        }

        /**
         * @return BtnViewModel
         */
        public function getPrimaryBtn(): BtnViewModel {
            return $this->primaryBtn;
        }

        /**
         * @return BtnViewModel[]
         */
        public function getOtherBtns(): array {
            return $this->otherBtns;
        }

        /**
         * @return string
         */
        public function getClasses(): string {
            return join(" ", $this->classes);
        }
    }
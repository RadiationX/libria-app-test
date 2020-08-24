<?php


    namespace app\models\view\detail;


    use app\models\view\BtnViewModel;

    class AppModViewModel {

        private BtnViewModel $primaryBtn;
        /**
         * @var BtnViewModel[]
         */
        private array $otherBtns;

        /**
         * AppModViewModel constructor.
         * @param BtnViewModel $primaryBtn
         * @param BtnViewModel[] $otherBtns
         */
        public function __construct(BtnViewModel $primaryBtn, array $otherBtns) {
            $this->primaryBtn = $primaryBtn;
            $this->otherBtns = $otherBtns;
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
    }
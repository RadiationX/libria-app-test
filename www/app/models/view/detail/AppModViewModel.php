<?php


    namespace app\models\view\detail;


    use app\models\view\BtnViewModel;

    class AppModViewModel {

        private BtnViewModel $primaryBtn;

        /**
         * AppModViewModel constructor.
         * @param string $link
         * @param string $icon
         * @param string $text
         */
        public function __construct(
            string $link,
            string $icon,
            string $text
        ) {
            $this->primaryBtn = new BtnViewModel(
                $link,
                $text,
                $icon,
                [BtnViewModel::CLASS_FILLED]
            );
        }

        /**
         * @return BtnViewModel
         */
        public function getPrimaryBtn(): BtnViewModel {
            return $this->primaryBtn;
        }
    }
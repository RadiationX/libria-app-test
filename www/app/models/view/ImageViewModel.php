<?php


    namespace app\models\view;


    use app\common\Utils;
    use app\models\MultiImage;

    class ImageViewModel {

        private MultiImage $multiImage;
        private string $class;

        /**
         * ImageViewModel constructor.
         * @param MultiImage $multiImage
         * @param string $class
         */
        public function __construct(MultiImage $multiImage, string $class = "") {
            $this->multiImage = $multiImage;
            $this->class = $class;
        }

        public function getDefault(): string {
            return Utils::fileTime("/res/images/{$this->multiImage->getDefault()}");
        }

        public function getSrcSet(): string {
            $srcSet = [];
            foreach ($this->multiImage->getScaled() as $scale => $url) {
                $fileUrl = Utils::fileTime("/res/images/$url");
                $srcSet[] = "$fileUrl $scale";
            }
            return join(", ", $srcSet);
        }

        /**
         * @return string
         */
        public function getClass(): string {
            return $this->class;
        }
    }
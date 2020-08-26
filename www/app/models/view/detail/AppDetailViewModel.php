<?php


    namespace app\models\view\detail;


    use app\models\view\BtnViewModel;
    use app\models\view\ImageViewModel;

    class AppDetailViewModel {

        private string $id;
        private string $name;
        private ?string $desc;
        private ImageViewModel $image;
        /**
         * @var AppModViewModel[]
         */
        private array $modifications;
        private bool $hasHidden;
        /**
         * @var BtnViewModel[]
         */
        private array $otherLinks;

        /**
         * AppDetailViewModel constructor.
         * @param string $id
         * @param string $name
         * @param ?string $desc
         * @param ImageViewModel $image
         * @param AppModViewModel[] $modifications
         * @param bool $hasHidden
         * @param BtnViewModel[] $otherLinks
         */
        public function __construct(
            string $id,
            string $name,
            ?string $desc,
            ImageViewModel $image,
            array $modifications,
            bool $hasHidden,
            array $otherLinks = []
        ) {
            $this->id = $id;
            $this->name = $name;
            $this->desc = $desc;
            $this->image = $image;
            $this->modifications = $modifications;
            $this->hasHidden = $hasHidden;
            $this->otherLinks = $otherLinks;
        }

        /**
         * @return string
         */
        public function getId(): string {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getName(): string {
            return $this->name;
        }

        /**
         * @return ?string
         */
        public function getDesc(): ?string {
            return $this->desc;
        }

        /**
         * @return ImageViewModel
         */
        public function getImage(): ImageViewModel {
            return $this->image;
        }

        /**
         * @return AppModViewModel[]
         */
        public function getModifications(): array {
            return $this->modifications;
        }

        /**
         * @return bool
         */
        public function hasHidden(): bool {
            return $this->hasHidden;
        }

        /**
         * @return BtnViewModel[]
         */
        public function otherLinks(): array {
            return $this->otherLinks;
        }
    }
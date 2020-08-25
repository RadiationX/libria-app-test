<?php


    namespace app\models\view\detail;


    class AppDetailViewModel {

        private string $id;
        private string $name;
        private string $smallDesc;
        private string $image;
        /**
         * @var AppModViewModel[]
         */
        private array $modifications;
        private bool $hasHidden;

        /**
         * AppDetailViewModel constructor.
         * @param string $id
         * @param string $name
         * @param string $smallDesc
         * @param string $image
         * @param AppModViewModel[] $modifications
         * @param bool $hasHidden
         */
        public function __construct(
            string $id,
            string $name,
            string $smallDesc,
            string $image,
            array $modifications,
            bool $hasHidden
        ) {
            $this->id = $id;
            $this->name = $name;
            $this->smallDesc = $smallDesc;
            $this->image = $image;
            $this->modifications = $modifications;
            $this->hasHidden = $hasHidden;
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
         * @return string
         */
        public function getSmallDesc(): string {
            return $this->smallDesc;
        }

        /**
         * @return string
         */
        public function getImage(): string {
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
    }
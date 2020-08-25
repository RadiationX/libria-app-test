<?php
    declare(strict_types=1);

    namespace app\models\detail;


    use app\models\AppTarget;

    class AppUpdate {

        private string $id;
        /**
         * @var AppModification[]
         */
        private array $modifications;

        /**
         * AppUpdate constructor.
         * @param string $id
         * @param AppModification[] $modifications
         */
        public function __construct(
            string $id,
            array $modifications
        ) {
            $this->id = $id;
            $this->modifications = $modifications;
        }

        /**
         * @return string
         */
        public function getId(): string {
            return $this->id;
        }

        /**
         * @return AppModification[]
         */
        public function getModifications(): array {
            return $this->modifications;
        }
    }
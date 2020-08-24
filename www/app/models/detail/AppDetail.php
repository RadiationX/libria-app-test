<?php
    declare(strict_types=1);

    namespace app\models\detail;


    use app\models\AppTarget;

    class AppDetail {

        private string $id;
        private string $formatVersion;
        private string $name;
        private string $slogan;
        private AppTarget $target;
        /**
         * @var AppModification[]
         */
        private array $modifications;

        /**
         * AppDetail constructor.
         * @param string $id
         * @param string $formatVersion
         * @param string $name
         * @param string $slogan
         * @param AppTarget $target
         * @param AppModification[] $modifications
         */
        public function __construct(
            string $id,
            string $formatVersion,
            string $name,
            string $slogan,
            AppTarget $target,
            array $modifications
        ) {
            $this->id = $id;
            $this->formatVersion = $formatVersion;
            $this->name = $name;
            $this->slogan = $slogan;
            $this->target = $target;
            $this->modifications = $modifications;
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
        public function getFormatVersion(): string {
            return $this->formatVersion;
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
        public function getSlogan(): string {
            return $this->slogan;
        }

        /**
         * @return AppTarget
         */
        public function getTarget(): AppTarget {
            return $this->target;
        }

        /**
         * @return AppModification[]
         */
        public function getModifications(): array {
            return $this->modifications;
        }
    }
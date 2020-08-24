<?php
    declare(strict_types=1);

    namespace app\models\detail;


    class AppModification {

        private string $os;
        private string $version;
        private string $channel;
        /**
         * @var AppSource[]
         */
        private array $sources;
        private ?string $abi;
        private ?string $minOsVersion;
        private ?string $description;

        /**
         * AppModification constructor.
         * @param string $os
         * @param string $version
         * @param string $channel
         * @param AppSource[] $sources
         * @param ?string $abi
         * @param ?string $minOsVersion
         * @param ?string $description
         */
        public function __construct(
            string $os,
            string $version,
            string $channel,
            array $sources,
            ?string $abi,
            ?string $minOsVersion,
            ?string $description
        ) {
            $this->os = $os;
            $this->version = $version;
            $this->channel = $channel;
            $this->sources = $sources;
            $this->abi = $abi;
            $this->minOsVersion = $minOsVersion;
            $this->description = $description;
        }

        /**
         * @return string
         */
        public function getOs(): string {
            return $this->os;
        }

        /**
         * @return string
         */
        public function getVersion(): string {
            return $this->version;
        }

        /**
         * @return string
         */
        public function getChannel(): string {
            return $this->channel;
        }

        /**
         * @return AppSource[]
         */
        public function getSources(): array {
            return $this->sources;
        }

        /**
         * @return string|null
         */
        public function getAbi(): ?string {
            return $this->abi;
        }

        /**
         * @return string|null
         */
        public function getMinOsVersion(): ?string {
            return $this->minOsVersion;
        }

        /**
         * @return string|null
         */
        public function getDescription(): ?string {
            return $this->description;
        }
    }
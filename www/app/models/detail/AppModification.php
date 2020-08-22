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
         * @param string|null $abi
         * @param string|null $minOsVersion
         * @param string|null $description
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

    }
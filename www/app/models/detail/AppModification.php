<?php
    declare(strict_types=1);

    namespace app\models\detail;


    class AppModification {

        private string $os;
        private string $channel;
        /**
         * @var string[]
         */
        private array $params;
        /**
         * @var AppSource[]
         */
        private array $sources;

        /**
         * AppModification constructor.
         * @param string $os
         * @param string $channel
         * @param array[] $params
         * @param AppSource[] $sources
         */
        public function __construct(
            string $os,
            string $channel,
            array $params,
            array $sources
        ) {
            $this->os = $os;
            $this->channel = $channel;
            $this->params = $params;
            $this->sources = $sources;
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
        public function getChannel(): string {
            return $this->channel;
        }

        /**
         * @return string[]
         */
        public function getParams(): array {
            return $this->params;
        }

        /**
         * @return AppSource[]
         */
        public function getSources(): array {
            return $this->sources;
        }
    }
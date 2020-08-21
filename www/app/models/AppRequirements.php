<?php

    namespace app\models;

    class AppRequirements {

        private array $os;
        private array $type;

        /**
         * AppRequirements constructor.
         * @param string[] $os
         * @param string[] $type
         */
        public function __construct(array $os, array $type) {
            $this->os = $os;
            $this->type = $type;
        }

        /**
         * @return string[]
         */
        public function getOsList() {
            return $this->os;
        }

        /**
         * @return string[]
         */
        public function getTypeList() {
            return $this->type;
        }
    }
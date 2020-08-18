<?php


    class AppRequirements {

        private $os = array(OS_UNKNOWN);
        private $type = array(TYPE_UNKNOWN);

        /**
         * AppRequirements constructor.
         * @param array $os
         * @param array $type
         */
        public function __construct(array $os, array $type) {
            $this->os = $os;
            $this->type = $type;
        }

        /**
         * @return array
         */
        public function getOs() {
            return $this->os;
        }

        /**
         * @return array
         */
        public function getType() {
            return $this->type;
        }
    }
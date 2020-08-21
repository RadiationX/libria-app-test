<?php

    namespace app\common;

    class AppsTargetHelper {

        private string $os;
        private string $type;
        private ?array $clientAppKeys = null;
        private ?array $otherAppKeys = null;

        /**
         * AppsTargetHelper constructor.
         * @param BrowserInfo $browserInfo
         */
        public function __construct(BrowserInfo $browserInfo) {
            $this->os = $browserInfo->getOs();
            $this->type = $browserInfo->getType();
        }

        /**
         * @return string[]
         */
        public function getClientAppKeys() {
            return Utils::lazyInit($this->clientAppKeys, function () {
                return $this->fetchClientAppKeys();
            });
        }


        /**
         * @return string[]
         */
        public function getOtherAppKeys() {
            return Utils::lazyInit($this->otherAppKeys, function () {
                return $this->fetchOtherAppKeys();
            });
        }

        /**
         * @return string[]
         */
        private function fetchClientAppKeys() {
            $filtered = array_filter(
                Consts::appTargets(),
                function ($req) {
                    $hasPlatform = in_array($this->os, $req->getOsList());
                    $hasType = in_array($this->type, $req->getTypeList());
                    return $hasPlatform && $hasType;
                },
                ARRAY_FILTER_USE_BOTH
            );
            $targetKeys = array_keys($filtered);

            return $this->sortByOrder($targetKeys);
        }


        /**
         * @return string[]
         */
        private function fetchOtherAppKeys() {
            $clientAppKeys = $this->getClientAppKeys();
            $allAppKeys = array_keys(Consts::appTargets());
            return array_values(array_diff($allAppKeys, $clientAppKeys));
        }

        /**
         * @param string[] $targetAppKeys
         * @return string[]
         */
        private function sortByOrder($targetAppKeys) {
            $appsOrder = Consts::appsOrder();
            if (!array_key_exists($this->os, $appsOrder)
                || !array_key_exists($this->type, $appsOrder[$this->os])) {
                return $targetAppKeys;
            }
            $order = $appsOrder[$this->os][$this->type];
            usort($targetAppKeys, function ($a, $b) use ($order) {
                foreach ($order as $value) {
                    if ($a === $value) {
                        return 0;
                    }
                    if ($b === $value) {
                        return 1;
                    }
                }
                return 0;
            });
            return $targetAppKeys;
        }
    }
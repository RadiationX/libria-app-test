<?php
    declare(strict_types=1);

    namespace app\common;

    class AppsTargetHelper {

        private static ?array $clientAppKeys = null;
        private static ?array $otherAppKeys = null;

        /**
         * @return string[]
         */
        public static function getClientAppKeys(): array {
            return Utils::lazyInit(self::$clientAppKeys, function () {
                return self::fetchClientAppKeys();
            });
        }

        /**
         * @return string[]
         */
        public static function getOtherAppKeys(): array {
            return Utils::lazyInit(self::$otherAppKeys, function () {
                return self::fetchOtherAppKeys();
            });
        }

        /**
         * @return string[]
         */
        private static function fetchClientAppKeys(): array {
            $os = BrowserInfo::getOs();
            $type = BrowserInfo::getType();
            $filtered = array_filter(
                Consts::appTargets(),
                function ($req) use ($os, $type) {
                    $hasPlatform = in_array($os, $req->getOsList());
                    $hasType = in_array($type, $req->getTypeList());
                    return $hasPlatform ;
                },
                ARRAY_FILTER_USE_BOTH
            );
            $targetKeys = array_keys($filtered);

            return self::sortByOrder($targetKeys);
        }


        /**
         * @return string[]
         */
        private static function fetchOtherAppKeys(): array {
            $type = BrowserInfo::getType();
            $clientAppKeys = self::getClientAppKeys();
            $allAppKeys = array_keys(Consts::appTargets());
            $otherAppKeys = array_values(array_diff($allAppKeys, $clientAppKeys));

            $appsByClientType = array_filter(
                $otherAppKeys,
                function ($appKey) use ($type) {
                    return in_array($type, Consts::appTargets()[$appKey]->getTypeList());
                },
                ARRAY_FILTER_USE_BOTH
            );
            $appsByClientType = array_values($appsByClientType);
            Utils::sortByOrder($otherAppKeys, $appsByClientType);
            return $otherAppKeys;
        }

        /**
         * @param string[] $targetAppKeys
         * @return string[]
         */
        private static function sortByOrder($targetAppKeys): array {
            $os = BrowserInfo::getOs();
            $type = BrowserInfo::getType();
            $appsOrder = Consts::appsOrder();
            if (!array_key_exists($os, $appsOrder)
                || !array_key_exists($type, $appsOrder[$os])) {
                return $targetAppKeys;
            }
            $order = $appsOrder[$os][$type];
            Utils::sortByOrder($targetAppKeys, $order);
            return $targetAppKeys;
        }
    }
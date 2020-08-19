<?php

    // из browscap
    $possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
    $possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];

    $APP_REQS = [
        APP_ANDROID => new AppRequirements(
            [OS_ANDROID],
            [TYPE_MOBILE]
        ),
        APP_ANDROID_TV => new AppRequirements(
            [OS_ANDROID],
            [TYPE_TV]
        ),
        APP_IOS => new AppRequirements(
            [OS_IOS],
            [TYPE_MOBILE, TYPE_TABLET]
        ),
        APP_MACOS_CATALYST => new AppRequirements(
            [OS_MACOS],
            [TYPE_DESKTOP]
        ),
        APP_WINTEN => new AppRequirements(
            [OS_WINDOWS],
            [TYPE_DESKTOP]
        ),
        APP_ANILIBRIX => new AppRequirements(
            [OS_MACOS, OS_LINUX, OS_WINDOWS],
            [TYPE_DESKTOP]
        ),
        APP_QT => new AppRequirements(
            [OS_MACOS, OS_LINUX, OS_WINDOWS],
            [TYPE_DESKTOP]
        )
    ];

    $APPS_ORDER = [
        OS_MACOS => [
            TYPE_DESKTOP => [
                APP_ANILIBRIX,
                APP_QT,
                APP_MACOS_CATALYST
            ]
        ],
        OS_LINUX => [
            TYPE_DESKTOP => [
                APP_ANILIBRIX,
                APP_QT
            ]
        ],
        OS_WINDOWS => [
            TYPE_DESKTOP => [
                APP_WINTEN,
                APP_ANILIBRIX,
                APP_QT
            ]
        ]
    ];

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
            global $APP_REQS;
            $filtered = array_filter(
                $APP_REQS,
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
            global $APP_REQS;
            $clientAppKeys = $this->getClientAppKeys();
            $allAppKeys = array_keys($APP_REQS);
            return array_values(array_diff($allAppKeys, $clientAppKeys));
        }

        /**
         * @param string[] $targetAppKeys
         * @return string[]
         */
        private function sortByOrder($targetAppKeys) {
            global $APPS_ORDER;
            if (!array_key_exists($this->os, $APPS_ORDER)
                || !array_key_exists($this->os, $APPS_ORDER[$this->os])) {
                return $targetAppKeys;
            }
            $order = $APPS_ORDER[$this->os][$this->type];
            usort($targetAppKeys, function ($a, $b) use ($order) {
                foreach ($order as $value) {
                    if ($a == $value) {
                        return 0;
                    }
                    if ($b == $value) {
                        return 1;
                    }
                }
                return 0;
            });
            return $targetAppKeys;
        }
    }
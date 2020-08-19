<?php


    class BrowserInfo {

        private ?array $browserInfo = null;
        private ?string $os = null;
        private ?string $type = null;

        /**
         * @return string
         */
        public function getOs(): string {
            return Utils::lazyInit($this->os, function () {
                return $this->fetchOsInfo();
            });
        }

        /**
         * @return string
         */
        public function getType(): string {
            return Utils::lazyInit($this->type, function () {
                return $this->fetchTypeInfo();
            });
        }

        /**
         * @return string
         */
        private function fetchOsInfo(): string {
            $os = $this->fetchBrowserInfo()['platform'];

            if (empty($os)) {
                return OS_UNKNOWN;
            }
            if (stripos($os, 'macos') !== false) {
                return OS_MACOS;
            }
            if (stripos($os, 'linux') !== false) {
                return OS_LINUX;
            }
            if (stripos($os, 'win') !== false) {
                return OS_WINDOWS;
            }
            if (stripos($os, 'android') !== false) {
                return OS_ANDROID;
            }
            if (stripos($os, 'ios') !== false) {
                return OS_IOS;
            }

            return OS_UNKNOWN;
        }

        /**
         * @return string
         */
        private function fetchTypeInfo(): string {
            $type = $this->fetchBrowserInfo()['device_type'];

            if (empty($type)) {
                return TYPE_UNKNOWN;
            }
            if (stripos($type, 'desktop') !== false) {
                return TYPE_DESKTOP;
            }
            if (stripos($type, 'tv') !== false) {
                return TYPE_TV;
            }
            if (stripos($type, 'mobile') !== false) {
                return TYPE_MOBILE;
            }
            if (stripos($type, 'tablet') !== false) {
                return TYPE_TABLET;
            }

            return TYPE_UNKNOWN;
        }

        /**
         * @return array
         */
        private function fetchBrowserInfo(): array {
            return Utils::lazyInit($this->browserInfo, function () {
                $browser = get_browser(null, true);
                if ($browser == false) {
                    return [];
                }
                return (array)$browser;
            });
        }
    }
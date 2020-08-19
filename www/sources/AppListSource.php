<?php


    class AppListSource {

        private ?array $list = null;

        /**
         * @return array
         */
        public function getList(): array {
            return Utils::lazyInit($this->list, function () {
                return $this->fetchList();
            });
        }

        /**
         * @return AppItem[]
         */
        private function fetchList() {
            return [
                APP_ANDROID => new AppItem(
                    '/app/android/',
                    APP_ANDROID,
                    'app_android_mobile.png',
                    'ic_android_primary.svg',
                    'AniLibria',
                    'Android'
                ),
                APP_ANDROID_TV => new AppItem(
                    '/app/android-tv/',
                    APP_ANDROID_TV,
                    'app_android_tv.png',
                    'ic_android_primary.svg',
                    'AniLibria',
                    'Android TV'
                ),
                APP_IOS => new AppItem(
                    '/app/ios/',
                    APP_IOS,
                    'app_ios.png',
                    'ic_apple_primary.svg',
                    'AniLibria',
                    'iOS'
                ),
                APP_MACOS_CATALYST => new AppItem(
                    '/app/catalyst/',
                    APP_MACOS_CATALYST,
                    'app_macos_catalyst.png',
                    'ic_apple_primary.svg',
                    'AniLibria Catalyst',
                    'macOS'
                ),
                APP_WINTEN => new AppItem(
                    '/app/win/',
                    APP_WINTEN,
                    'app_winten.png',
                    'ic_windows_primary.svg',
                    'AniLibria',
                    'Windows 10'
                ),
                APP_ANILIBRIX => new AppItem(
                    '/app/anilibrix/',
                    APP_ANILIBRIX,
                    'app_cross_anilibrix.png',
                    'ic_macbook_primary.svg',
                    'AniLibriX',
                    'PC/Mac/Linux'
                ),
                APP_QT => new AppItem(
                    '/app/qt/',
                    APP_QT,
                    'app_cross_qt.png',
                    'ic_macbook_primary.svg',
                    'AniLibria QT',
                    'PC/Mac/Linux'
                )
            ];
        }

    }
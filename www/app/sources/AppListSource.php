<?php

    namespace app\sources;

    use app\common\Consts;
    use app\common\Utils;
    use app\models\AppItem;

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
                Consts::APP_ANDROID => new AppItem(
                    '/app/android/',
                    Consts::APP_ANDROID,
                    'app_android_mobile.png',
                    'ic_android_primary.svg',
                    'AniLibria',
                    'Android'
                ),
                Consts::APP_ANDROID_TV => new AppItem(
                    '/app/android-tv/',
                    Consts::APP_ANDROID_TV,
                    'app_android_tv.png',
                    'ic_android_primary.svg',
                    'AniLibria',
                    'Android TV'
                ),
                Consts::APP_IOS => new AppItem(
                    '/app/ios/',
                    Consts::APP_IOS,
                    'app_ios.png',
                    'ic_apple_primary.svg',
                    'AniLibria',
                    'iOS'
                ),
                Consts::APP_MACOS_CATALYST => new AppItem(
                    '/app/catalyst/',
                    Consts::APP_MACOS_CATALYST,
                    'app_macos_catalyst.png',
                    'ic_apple_primary.svg',
                    'AniLibria Catalyst',
                    'macOS'
                ),
                Consts::APP_WINTEN => new AppItem(
                    '/app/win/',
                    Consts::APP_WINTEN,
                    'app_winten.png',
                    'ic_windows_primary.svg',
                    'AniLibria',
                    'Windows 10'
                ),
                Consts::APP_ANILIBRIX => new AppItem(
                    '/app/anilibrix/',
                    Consts::APP_ANILIBRIX,
                    'app_cross_anilibrix.png',
                    'ic_macbook_primary.svg',
                    'AniLibriX',
                    'PC/Mac/Linux'
                ),
                Consts::APP_QT => new AppItem(
                    '/app/qt/',
                    Consts::APP_QT,
                    'app_cross_qt.png',
                    'ic_macbook_primary.svg',
                    'AniLibria QT',
                    'PC/Mac/Linux'
                )
            ];
        }

    }
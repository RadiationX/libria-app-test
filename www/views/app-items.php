<?php

    // из browscap
    $possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
    $possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];

    $appList = [
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

    $appReqs = [
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

    $priorities = [
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

    $browserInfo = get_browser(null, true);

    function getClientPlatform($browserInfo) {
        $platform = $browserInfo['platform'];

        if (stripos($platform, 'macos') !== false) {
            return OS_MACOS;
        }
        if (stripos($platform, 'linux') !== false) {
            return OS_LINUX;
        }
        if (stripos($platform, 'win') !== false) {
            return OS_WINDOWS;
        }
        if (stripos($platform, 'android') !== false) {
            return OS_ANDROID;
        }
        if (stripos($platform, 'ios') !== false) {
            return OS_IOS;
        }

        return OS_UNKNOWN;
    }

    function getClientType($browserInfo) {
        $type = $browserInfo['device_type'];

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

    function getClientApps($appReqs, $browserInfo) {
        $platform = getClientPlatform($browserInfo);
        $type = getClientType($browserInfo);
        $filtered = array_filter(
            $appReqs,
            function ($req) use ($platform, $type) {
                $hasPlatform = in_array($platform, $req->getOs());
                $hasType = in_array($type, $req->getType());
                return $hasPlatform && $hasType;
            },
            ARRAY_FILTER_USE_BOTH
        );

        return array_keys($filtered);
    }

    function sortByPriority($clientApps, $priorities, $browserInfo) {
        $platform = getClientPlatform($browserInfo);
        $type = getClientType($browserInfo);
        if (array_key_exists($platform, $priorities) && array_key_exists($type, $priorities[$platform])) {
            $order = $priorities[$platform][$type];
            usort($clientApps, function ($a, $b) use ($order) {
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
        }
        return $clientApps;
    }

    $clientAppKeys = getClientApps($appReqs, $browserInfo);
    $sortedAppsKeys = sortByPriority($clientAppKeys, $priorities, $browserInfo);
    $allAppKeys = array_keys($appReqs);
    $otherAppsKeys = array_values(array_diff($allAppKeys, $sortedAppsKeys));

?>

<main class='main clearfix'>

    <?php
        $mustache = DI::mustache();
        $tpl = $mustache->loadTemplate('app-item');

        foreach ($sortedAppsKeys as $appKey) {
            echo $tpl->render($appList[$appKey]);
        }

        foreach ($otherAppsKeys as $appKey) {
            echo $tpl->render($appList[$appKey]);
        }
    ?>

</main>

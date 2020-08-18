<?php

    $mustache = DI::mustache();
    $tpl = $mustache->loadTemplate('app-item');

    // из browscap
    $possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
    $possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];

    $appsData = [
        APP_ANDROID => [
            'link' => '/app/android/',
            'type' => APP_ANDROID,
            'image' => 'app_android_mobile.png',
            'icon' => 'ic_android_primary.svg',
            'name' => 'AniLibria',
            'platform' => 'Android'
        ],
        APP_ANDROID_TV => [
            'link' => '/app/android-tv/',
            'type' => APP_ANDROID_TV,
            'image' => 'app_android_tv.png',
            'icon' => 'ic_android_primary.svg',
            'name' => 'AniLibria',
            'platform' => 'Android TV'
        ],
        APP_IOS => [
            'link' => '/app/ios/',
            'type' => APP_IOS,
            'image' => 'app_ios.png',
            'icon' => 'ic_apple_primary.svg',
            'name' => 'AniLibria',
            'platform' => 'iOS'
        ],
        APP_MACOS_CATALYST => [
            'link' => '/app/catalyst/',
            'type' => APP_MACOS_CATALYST,
            'image' => 'app_macos_catalyst.png',
            'icon' => 'ic_apple_primary.svg',
            'name' => 'AniLibria Catalyst',
            'platform' => 'macOS'
        ],
        APP_WINTEN => [
            'link' => '/app/win/',
            'type' => APP_WINTEN,
            'image' => 'app_winten.png',
            'icon' => 'ic_windows_primary.svg',
            'name' => 'AniLibria',
            'platform' => 'Windows 10'
        ],
        APP_ANILIBRIX => [
            'link' => '/app/anilibrix/',
            'type' => APP_ANILIBRIX,
            'image' => 'app_cross_anilibrix.png',
            'icon' => 'ic_macbook_primary.svg',
            'name' => 'AniLibriX',
            'platform' => 'PC/Mac/Linux'
        ],
        APP_QT => [
            'link' => '/app/qt/',
            'type' => APP_QT,
            'image' => 'app_cross_qt.png',
            'icon' => 'ic_macbook_primary.svg',
            'name' => 'AniLibria QT',
            'platform' => 'PC/Mac/Linux'
        ]
    ];

    $appTypes = [
        APP_ANDROID => [
            'platform' => [OS_ANDROID],
            'type' => [TYPE_MOBILE]
        ],
        APP_ANDROID_TV => [
            'platform' => [OS_ANDROID],
            'type' => [TYPE_TV]
        ],
        APP_IOS => [
            'platform' => [OS_IOS],
            'type' => [TYPE_MOBILE, TYPE_TABLET]
        ],
        APP_MACOS_CATALYST => [
            'platform' => [OS_MACOS],
            'type' => [TYPE_DESKTOP]
        ],
        APP_WINTEN => [
            'platform' => [OS_WINDOWS],
            'type' => [TYPE_DESKTOP]
        ],
        APP_ANILIBRIX => [
            'platform' => [OS_MACOS, OS_LINUX, OS_WINDOWS],
            'type' => [TYPE_DESKTOP]
        ],
        APP_QT => [
            'platform' => [OS_MACOS, OS_LINUX, OS_WINDOWS],
            'type' => [TYPE_DESKTOP]
        ]
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

    function getClientApps($appTypes, $browserInfo) {
        $platform = getClientPlatform($browserInfo);
        $type = getClientType($browserInfo);
        $filtered = array_filter(
            $appTypes,
            function ($value) use ($platform, $type) {
                $hasPlatform = in_array($platform, $value['platform']);
                $hasType = in_array($type, $value['type']);
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

    $clientAppKeys = getClientApps($appTypes, $browserInfo);
    $sortedAppsKeys = sortByPriority($clientAppKeys, $priorities, $browserInfo);
    $allAppKeys = array_keys($appTypes);
    $otherAppsKeys = array_values(array_diff($allAppKeys, $sortedAppsKeys));

?>

<main class='main clearfix'>

    <?php
        foreach ($sortedAppsKeys as $appKey) {
            echo $tpl->render($appsData[$appKey]);
        }
    ?>
    <?php
        foreach ($otherAppsKeys as $appKey) {
            echo $tpl->render($appsData[$appKey]);
        }
    ?>

</main>

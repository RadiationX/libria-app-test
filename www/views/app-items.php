<?php
$tpl = $mustache->loadTemplate('app-item');

// из browscap
$possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
$possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];

$appsData = [
    'android_mobile' => [
        'link' => '/android/',
        'type' => 'android-mobile',
        'image' => 'app_android_mobile.png',
        'icon' => 'ic_android_primary.svg',
        'name' => 'AniLibria',
        'platform' => 'Android'
    ],
    'android_tv' => [
        'link' => '/android-tv/',
        'type' => 'android-mobile',
        'image' => 'app_android_tv.png',
        'icon' => 'ic_android_primary.svg',
        'name' => 'AniLibria',
        'platform' => 'Android TV'
    ],
    'ios' => [
        'link' => '/ios/',
        'type' => 'android-mobile',
        'image' => 'app_ios.png',
        'icon' => 'ic_apple_primary.svg',
        'name' => 'AniLibria',
        'platform' => 'iOS'
    ],
    'macos_catalyst' => [
        'link' => '/catalyst/',
        'type' => 'android-mobile',
        'image' => 'app_macos_catalyst.png',
        'icon' => 'ic_apple_primary.svg',
        'name' => 'AniLibria Catalyst',
        'platform' => 'macOS'
    ],
    'winten' => [
        'link' => '/win/',
        'type' => 'android-mobile',
        'image' => 'app_winten.png',
        'icon' => 'ic_windows_primary.svg',
        'name' => 'AniLibria',
        'platform' => 'Windows 10'
    ],
    'cross_anilibrix' => [
        'link' => '/anilibrix/',
        'type' => 'android-mobile',
        'image' => 'app_cross_anilibrix.png',
        'icon' => 'ic_macbook_primary.svg',
        'name' => 'AniLibriX',
        'platform' => 'PC/Mac/Linux'
    ],
    'cross_qt' => [
        'link' => '/qt/',
        'type' => 'android-mobile',
        'image' => 'app_cross_qt.png',
        'icon' => 'ic_macbook_primary.svg',
        'name' => 'AniLibria QT',
        'platform' => 'PC/Mac/Linux'
    ]
];

$appTypes = [
    'android_mobile' => [
        'platform' => ['android'],
        'type' => ['mobile']
    ],
    'android_tv' => [
        'platform' => ['android'],
        'type' => ['tv']
    ],
    'ios' => [
        'platform' => ['ios'],
        'type' => ['mobile', 'tablet']
    ],
    'macos_catalyst' => [
        'platform' => ['macos'],
        'type' => ['desktop']
    ],
    'winten' => [
        'platform' => ['windows'],
        'type' => ['desktop']
    ],
    'cross_anilibrix' => [
        'platform' => ['macos', 'linux', 'windows'],
        'type' => ['desktop']
    ],
    'cross_qt' => [
        'platform' => ['macos', 'linux', 'windows'],
        'type' => ['desktop']
    ]
];

$priorities = [
    "macos" => [
        "desktop" => [
            "cross_anilibrix",
            "cross_qt",
            "macos_catalyst"
        ]
    ],
    "linux" => [
        "desktop" => [
            "cross_anilibrix",
            "cross_qt"
        ]
    ],
    "window" => [
        "desktop" => [
            "winten",
            "cross_anilibrix",
            "cross_qt"
        ]
    ]
];

$browserInfo = get_browser(null, true);

function getClientPlatform($browserInfo) {
    $platform = $browserInfo['platform'];

    if (stripos($platform, 'macos') !== false) {
        return 'macos';
    }
    if (stripos($platform, 'linux') !== false) {
        return 'linux';
    }
    if (stripos($platform, 'win') !== false) {
        return 'windows';
    }
    if (stripos($platform, 'android') !== false) {
        return 'android';
    }
    if (stripos($platform, 'ios') !== false) {
        return 'ios';
    }

    return 'unknown';
}

function getClientType($browserInfo) {
    $type = $browserInfo['device_type'];

    if (stripos($type, 'desktop') !== false) {
        return 'desktop';
    }
    if (stripos($type, 'tv') !== false) {
        return 'tv';
    }
    if (stripos($type, 'mobile') !== false) {
        return 'mobile';
    }
    if (stripos($type, 'tablet') !== false) {
        return 'tablet';
    }

    return 'unknown';
}

function getClientApps($appTypes, $browserInfo) {
    $platform = getClientPlatform($browserInfo);
    $type = getClientType($browserInfo);
    $filtered = array_filter(
        $appTypes,
        function ($value, $key) use ($platform, $type) {
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

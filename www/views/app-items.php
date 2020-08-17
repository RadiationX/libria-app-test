<?php
$tpl = $mustache->loadTemplate('app-item');

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
    $possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
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
    $possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];
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

function sortPopularity($clientApps, $priorities, $browserInfo) {
    $platform = getClientPlatform($browserInfo);
    $type = getClientType($browserInfo);
    if (array_key_exists($platform, $priorities) && array_key_exists($type, $priorities[$platform])) {
        $order = $priorities[$platform][$type];
        usort($clientApps, function ($a, $b) use ($order) {
            echo "sort $a, $b <br>";
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

echo 'platform: ' . getClientPlatform($browserInfo) . PHP_EOL;
echo 'type: ' . getClientType($browserInfo) . PHP_EOL;
$clientApps = getClientApps($appTypes, $browserInfo);
$sortedApps = sortPopularity($clientApps, $priorities, $browserInfo);
$allApps = array_keys($appTypes);
$finalApps = array_values(array_unique(array_merge($sortedApps, $allApps)));
$finalApps = array_values(array_diff($allApps, $sortedApps));
echo json_encode($clientApps);
echo json_encode($sortedApps);
echo json_encode($clientApps);
echo json_encode($finalApps);


echo $tpl->render(array(
    'link' => '/android/',
    'type' => 'android-mobile',
    'image' => 'app_android_mobile.png',
    'icon' => 'ic_android_primary.svg',
    'name' => 'AniLibria',
    'platform' => 'Android'
));

?>

<main class='main clearfix'>

</main>

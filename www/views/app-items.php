<?php
$tpl = $mustache->loadTemplate( 'app-item' );



$appTypes = [
    'android_mobile' =>[
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

$browserInfo = get_browser( null, true );

function getClientPlatform( $browserInfo ) {
    $possiblePlatforms = ['unknown', 'Linux', 'Android', 'Win10', 'Win8.1', 'Win8', 'Win7', 'MacOSX', 'WinVista', 'iOS', 'Xbox OS 10', 'WinPhone10', 'Xbox OS 10 (Mobile View)', 'Win32', 'WinPhone8.1', 'ipadOS', 'Win64', 'Xbox OS', 'Xbox 360'];
    $platform = $browserInfo['platform'];

    if ( stripos( $platform, 'macos' ) !== false ) {
        return "macos";
    }
    if ( stripos( $platform, 'linux' ) !== false ) {
        return "linux";
    }
    if ( stripos( $platform, 'win' ) !== false ) {
        return "windows";
    }
    
    if ( stripos( $platform, 'android' ) !== false ) {
        return "android";
    }
    if ( stripos( $platform, 'ios' ) !== false ) {
        return "ios";
    }

    return 'unknown';
}

function getClientType($browserInfo){
    $possibleDeviceTypes = ['unknown', 'Desktop', 'TV Device', 'Mobile Phone', 'Tablet', 'Mobile Device'];
    $type = $browserInfo['device_type'];
    
    if ( stripos( $type, 'desktop' ) !== false ) {
        return "desktop";
    }
    if ( stripos( $type, 'tv' ) !== false ) {
        return "tv";
    }
    if ( stripos( $type, 'mobile' ) !== false ) {
        return "mobile";
    }
    if ( stripos( $type, 'tablet' ) !== false ) {
        return "tablet";
    }
    
    return 'unknown';
}

echo "platform: ".getClientPlatform($browserInfo).PHP_EOL;
echo "type: ".getClientType($browserInfo);

echo $tpl->render( array(
    'link' => '/android/',
    'type' => 'android-mobile',
    'image' => 'app_android_mobile.png',
    'icon' => 'ic_android_primary.svg',
    'name' => 'AniLibria',
    'platform' => 'Android'
) );

?>

<main class = 'main clearfix'>

</main>

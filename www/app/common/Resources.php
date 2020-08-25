<?php


    namespace app\common;


    class Resources {

        const IC_ANDROID_PRIMARY = "ic_android_primary.svg";
        const IC_ANDROID_WHITE = "ic_android_white.svg";
        const IC_ANILIBRIA_WHITE = "ic_anilibria_white.svg";
        const IC_APPLE_PRIMARY = "ic_apple_primary.svg";
        const IC_APPLE_WHITE = "ic_apple_white.svg";
        const IC_GITHUB_PRIMARY = "ic_github_primary.svg";
        const IC_GITHUB_WHITE = "ic_github_white.svg";
        const IC_LINUX_PRIMARY = "ic_linux_primary.svg";
        const IC_LINUX_WHITE = "ic_linux_white.svg";
        const IC_MACBOOK_PRIMARY = "ic_macbook_primary.svg";
        const IC_MACBOOK_WHITE = "ic_macbook_white.svg";
        const IC_WINDOWS_PRIMARY = "ic_windows_primary.svg";
        const IC_WINDOWS_WHITE = "ic_windows_white.svg";

        const OS_PRIMARY = [
            Consts::OS_ANDROID => self::IC_ANDROID_PRIMARY,
            Consts::OS_IOS => self::IC_APPLE_PRIMARY,
            Consts::OS_MACOS => self::IC_APPLE_PRIMARY,
            Consts::OS_LINUX => self::IC_LINUX_PRIMARY,
            Consts::OS_WINDOWS => self::IC_WINDOWS_PRIMARY
        ];

        const OS_WHITE = [
            Consts::OS_ANDROID => self::IC_ANDROID_WHITE,
            Consts::OS_IOS => self::IC_APPLE_WHITE,
            Consts::OS_MACOS => self::IC_APPLE_WHITE,
            Consts::OS_LINUX => self::IC_LINUX_WHITE,
            Consts::OS_WINDOWS => self::IC_WINDOWS_WHITE
        ];

        const APP_PRIMARY = [
            Consts::APP_ANDROID => self::IC_ANDROID_PRIMARY,
            Consts::APP_ANDROID_TV => self::IC_ANDROID_PRIMARY,
            Consts::APP_IOS => self::IC_APPLE_PRIMARY,
            Consts::APP_MACOS_CATALYST => self::IC_APPLE_PRIMARY,
            Consts::APP_WINTEN => self::IC_WINDOWS_PRIMARY,
            Consts::APP_ANILIBRIX => self::IC_MACBOOK_PRIMARY,
            Consts::APP_QT => self::IC_MACBOOK_PRIMARY
        ];

        const APP_WHITE = [
            Consts::APP_ANDROID => self::IC_ANDROID_WHITE,
            Consts::APP_ANDROID_TV => self::IC_ANDROID_WHITE,
            Consts::APP_IOS => self::IC_APPLE_WHITE,
            Consts::APP_MACOS_CATALYST => self::IC_APPLE_WHITE,
            Consts::APP_WINTEN => self::IC_WINDOWS_WHITE,
            Consts::APP_ANILIBRIX => self::IC_MACBOOK_WHITE,
            Consts::APP_QT => self::IC_MACBOOK_WHITE
        ];

    }
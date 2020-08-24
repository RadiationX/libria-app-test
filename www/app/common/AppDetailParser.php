<?php
    declare(strict_types=1);

    namespace app\common;


    use app\models\detail\AppDetail;
    use app\models\detail\AppModification;
    use app\models\detail\AppSource;
    use Exception;

    class AppDetailParser {

        private static string $FORMAT_V_1_0 = "1.0";

        private static string $SOURCE_TYPE_FILE = "file";
        private static string $SOURCE_TYPE_SITE = "site";

        /**
         * @param array $json
         * @return AppDetail
         * @throws Exception
         */
        static function parse(array $json): AppDetail {
            $format = self::requireFormat($json["format_version"]);
            $id = self::requireAppId($json["id"]);

            $target = Consts::appTargets()[$id];
            $modifications = array_map(function ($itemJson) {
                return self::parseModification($itemJson);
            }, $json["modifications"] ?: []);

            return new AppDetail(
                $id,
                $format,
                $json["name"],
                $json["slogan"],
                $target,
                $modifications
            );
        }

        /**
         * @param array $json
         * @return AppModification
         * @throws Exception
         */
        private static function parseModification(array $json): AppModification {
            $os = self::requireOs($json["os"]);
            $channel = self::requireChannel($json["channel"]);
            $sources = array_map(function ($itemJson) {
                return self::parseSource($itemJson);
            }, $json["sources"] ?: []);
            return new AppModification(
                $os,
                $json["version"],
                $channel,
                $sources,
                $json["abi"],
                $json["min_os_v"],
                $json["description"]
            );
        }

        /**
         * @param array $json
         * @return AppSource
         * @throws Exception
         */
        private static function parseSource(array $json): AppSource {
            $type = self::requireSourceType($json["type"]);
            return new AppSource(
                $json["title"],
                $type,
                $json["link"],
                $json["service"]
            );
        }

        /**
         * @param string $id
         * @return string
         * @throws Exception
         */
        private static function requireAppId(string $id): string {
            $valid = in_array($id, Consts::APP_KEYS, true);
            if (!$valid) {
                throw self::valueError("app id", $id);
            }
            return $id;
        }

        /**
         * @param ?string $format
         * @return string
         * @throws Exception
         */
        private static function requireFormat(?string $format): string {
            $valid = $format === self::$FORMAT_V_1_0;
            if (!$valid) {
                throw self::valueError("format", $format);
            }
            return $format;
        }

        /**
         * @param ?string $os
         * @return string
         * @throws Exception
         */
        private static function requireOs(string $os): string {
            $valid = in_array($os, Consts::OS_KEYS, true);
            if (!$valid) {
                throw self::valueError("os", $os);
            }
            return $os;
        }

        /**
         * @param ?string $channel
         * @return string
         * @throws Exception
         */
        private static function requireChannel(string $channel): string {
            $valid = in_array($channel, Consts::CHANNEL_KEYS, true);
            if (!$valid) {
                throw self::valueError("channel", $channel);
            }
            return $channel;
        }

        /**
         * @param ?string $type
         * @return string
         * @throws Exception
         */
        private static function requireSourceType(string $type): string {
            $valid = $type === self::$SOURCE_TYPE_FILE || $type === self::$SOURCE_TYPE_SITE;
            if (!$valid) {
                throw self::valueError("source type", $type);
            }
            return $type;
        }

        /**
         * @param string $field
         * @param ?string $value
         * @return Exception
         */
        private static function valueError(string $field, ?string $value): Exception {
            $message = sprintf(
                "unknown %s '%s'",
                $field,
                var_export($value, true)
            );
            return new Exception($message);
        }

    }
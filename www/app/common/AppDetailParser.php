<?php
    declare(strict_types=1);

    namespace app\common;


    use app\models\detail\AppUpdate;
    use app\models\detail\AppModification;
    use app\models\detail\AppSource;
    use Exception;

    class AppDetailParser {

        /**
         * @param array $json
         * @return AppUpdate
         * @throws Exception
         */
        static function parse(array $json): AppUpdate {
            $id = self::requireAppId($json["id"]);

            $modifications = array_map(function ($itemJson) {
                return self::parseModification($itemJson);
            }, $json["modifications"] ?: []);

            return new AppUpdate(
                $id,
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
            $params = $json["params"] ?: [];
            $mustShownParams = $json["mustShownParams"] ?: [];
            return new AppModification(
                $os,
                $channel,
                $params,
                $mustShownParams,
                $sources
            );
        }

        /**
         * @param array $json
         * @return AppSource
         * @throws Exception
         */
        private static function parseSource(array $json): AppSource {
            return new AppSource(
                $json["title"],
                $json["link"]
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
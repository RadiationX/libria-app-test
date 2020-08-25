<?php


    namespace app\sources;


    use app\common\AppDetailParser;
    use app\models\detail\AppUpdate;

    class AppDetailSource {

        public function getDetail($appId): ?AppUpdate {
            $filePath = $_SERVER["DOCUMENT_ROOT"] . "/data/apps/default/app_$appId.json";
            if (!file_exists($filePath)) {
                return null;
            }
            try {
                $file = file_get_contents($filePath);
                $json = json_decode($file, true);
                return AppDetailParser::parse($json);
            } catch (\Exception $e) {
            }
            return null;
        }

    }
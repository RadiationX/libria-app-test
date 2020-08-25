<?php


    namespace app\sources;


    use app\common\AppDetailParser;
    use app\models\detail\AppUpdate;
    use Exception;

    class AppDetailSource {

        public function getDetail($appId): AppUpdate {
            $filePath = $_SERVER["DOCUMENT_ROOT"] . "/data/apps/default/app_$appId.json";
            if (!file_exists($filePath)) {
                throw new Exception("Not found update info");
            }
            $file = file_get_contents($filePath);
            $json = json_decode($file, true);
            $update = AppDetailParser::parse($json);
            if ($update->getId() != $appId) {
                throw new Exception("Wrong appid " . $update->getId());
            }
            return $update;
        }

    }
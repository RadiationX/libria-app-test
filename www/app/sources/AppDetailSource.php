<?php


    namespace app\sources;


    use app\common\AppDetailParser;
    use app\models\detail\AppDetail;

    class AppDetailSource {

        public function getDetail($appId): AppDetail {
            $file = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data/apps/default/app_$appId.json");
            $json = json_decode($file, true);
            $detail = AppDetailParser::parse($json);
            return $detail;
        }

    }
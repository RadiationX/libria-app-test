<?php


    class AppListView {

        private Mustache_Engine $mustache;
        private Mustache_Template $tplList;
        private Mustache_Template $tplItem;

        /**
         * AppListView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct($mustache) {
            $this->mustache = $mustache;
            $this->tplList = $mustache->loadTemplate('app-list');
            $this->tplItem = $mustache->loadTemplate('app-item');
        }

        /**
         * @param AppItem[] $appList
         * @param string[] $clientAppKeys
         * @param string[] $otherAppKeys
         * @return string
         */
        public function render($appList, $clientAppKeys, $otherAppKeys) {
            $tplItem = $this->tplItem;
            return $this->tplList->render([
                'clientApps' => $clientAppKeys,
                'otherApps' => $otherAppKeys,
                'hasOther' => !empty($otherAppKeys),
                'itemTplWrapper' => function ($text, Mustache_LambdaHelper $helper) use ($appList, $tplItem) {
                    $appKey = trim($helper->render($text));
                    $app = $appList[$appKey];
                    return $tplItem->render($app);
                }
            ]);
        }
    }
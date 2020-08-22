<?php


    namespace app\views;


    use app\models\AppItem;
    use app\models\detail\AppDetail;
    use Mustache_Engine;
    use Mustache_Template;

    class AppDetailView {

        private Mustache_Template $tpl;

        /**
         * AppDetailView constructor.
         * @param Mustache_Engine $mustache
         */
        public function __construct(Mustache_Engine $mustache) {
            $this->tpl = $mustache->loadTemplate("app-detail");
        }

        public function render(?AppDetail $appDetail, AppItem $appItem): string {
            return $this->tpl->render([
                "image" => '/res/images/' . $appItem->getImage(),
                "name" => $appItem->getName(),
                "desc" => "Powerfull slogan description"
            ]);
        }

    }
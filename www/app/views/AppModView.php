<?php


    namespace app\views;


    use app\models\detail\AppModification;
    use Mustache_Engine;
    use Mustache_LambdaHelper;
    use Mustache_Template;

    class AppModView {

        private Mustache_Template $tpl;
        private BtnView $btnView;

        /**
         * AppModView constructor.
         * @param Mustache_Engine $mustache
         * @param BtnView $btnView
         */
        public function __construct(
            Mustache_Engine $mustache,
            BtnView $btnView
        ) {
            $this->tpl = $mustache->loadTemplate("app-mod");
            $this->btnView = $btnView;
        }

        public function render(AppModification $mod): string {
            $classes = "";
            return $this->tpl->render([
                "classes" => $classes,
                "btnTplWrapper" => function ($text, Mustache_LambdaHelper $helper) use ($appList) {
                    $appKey = trim($helper->render($text));
                    $app = $appList[$appKey];
                    return $this->btnView->render($app);
                }
            ]);
        }

    }
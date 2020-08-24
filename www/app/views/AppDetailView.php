<?php


    namespace app\views;


    use app\models\AppItem;
    use app\models\detail\AppDetail;
    use app\models\view\detail\AppDetailViewModel;
    use app\models\view\detail\AppModViewModel;
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
            $app = new AppDetailViewModel(
                $appItem->getId(),
                "unknown",
                "Powerful slogan description",
                "/res/images/{$appItem->getImage()}",
                [
                    new AppModViewModel(
                        "http://vk.com/",
                        "/res/icons/ic_apple_white.svg",
                        "Скачать для Аппле"
                    ),
                    new AppModViewModel(
                        "http://vk.com/",
                        "/res/icons/ic_windows_white.svg",
                        "Скачать для Виндус"
                    ),
                    new AppModViewModel(
                        "http://vk.com/",
                        "/res/icons/ic_linux_white.svg",
                        "Скачать для Линукс"
                    )
                ]
            );
            return $this->tpl->render($app);
        }

    }
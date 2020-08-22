<?php
    declare(strict_types=1);

    namespace app\models\detail;


    use app\models\AppTarget;

    class AppDetail {

        private string $id;
        private string $formatVersion;
        private string $name;
        private string $slogan;
        private AppTarget $target;
        /**
         * @var AppModification[]
         */
        private array $modifications;

        /**
         * AppDetail constructor.
         * @param string $id
         * @param string $formatVersion
         * @param string $name
         * @param string $slogan
         * @param AppTarget $target
         * @param AppModification[] $modifications
         */
        public function __construct(
            string $id,
            string $formatVersion,
            string $name,
            string $slogan,
            AppTarget $target,
            array $modifications
        ) {
            $this->id = $id;
            $this->formatVersion = $formatVersion;
            $this->name = $name;
            $this->slogan = $slogan;
            $this->target = $target;
            $this->modifications = $modifications;
        }


    }
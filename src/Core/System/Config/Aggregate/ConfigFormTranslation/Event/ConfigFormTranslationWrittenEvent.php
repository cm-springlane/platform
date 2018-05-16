<?php declare(strict_types=1);

namespace Shopware\System\Config\Aggregate\ConfigFormTranslation\Event;

use Shopware\System\Config\Aggregate\ConfigFormTranslation\ConfigFormTranslationDefinition;
use Shopware\Framework\ORM\Write\WrittenEvent;

class ConfigFormTranslationWrittenEvent extends WrittenEvent
{
    public const NAME = 'config_form_translation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return ConfigFormTranslationDefinition::class;
    }
}
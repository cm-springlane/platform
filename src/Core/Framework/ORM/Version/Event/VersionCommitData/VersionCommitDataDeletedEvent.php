<?php declare(strict_types=1);

namespace Shopware\Framework\ORM\Version\Event\VersionCommitData;

use Shopware\Framework\ORM\Write\DeletedEvent;
use Shopware\Framework\ORM\Write\WrittenEvent;
use Shopware\Framework\ORM\Version\Definition\VersionCommitDataDefinition;

class VersionCommitDataDeletedEvent extends WrittenEvent implements DeletedEvent
{
    public const NAME = 'version_commit_data.deleted';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return VersionCommitDataDefinition::class;
    }
}
<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Event;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;

class EntityDeletedEvent extends EntityWrittenEvent
{
    public function __construct(
        string $definition,
        array $writeResult,
        Context $context,
        array $errors = []
    ) {
        parent::__construct($definition, $writeResult, $context, $errors);

        /* @var string|EntityDefinition $definition */
        $this->name = $definition::getEntityName() . '.deleted';
    }
}

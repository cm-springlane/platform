<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Snippet\Aggregate\SnippetSet;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\AttributesField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\RestrictDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\Snippet\SnippetDefinition;
use Shopware\Core\System\SalesChannel\Aggregate\SalesChannelDomain\SalesChannelDomainDefinition;

class SnippetSetDefinition extends EntityDefinition
{
    public static function getEntityName(): string
    {
        return 'snippet_set';
    }

    public static function getCollectionClass(): string
    {
        return SnippetSetCollection::class;
    }

    public static function getEntityClass(): string
    {
        return SnippetSetEntity::class;
    }

    protected static function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name'))->addFlags(new Required()),
            (new StringField('base_file', 'baseFile'))->addFlags(new Required()),
            (new StringField('iso', 'iso'))->addFlags(new Required()),
            new AttributesField(),
            new CreatedAtField(),
            new UpdatedAtField(),
            (new OneToManyAssociationField('snippets', SnippetDefinition::class, 'snippet_set_id'))->addFlags(new CascadeDelete()),
            (new OneToManyAssociationField('salesChannelDomains', SalesChannelDomainDefinition::class, 'snippet_set_id'))->addFlags(new RestrictDelete()),
        ]);
    }
}

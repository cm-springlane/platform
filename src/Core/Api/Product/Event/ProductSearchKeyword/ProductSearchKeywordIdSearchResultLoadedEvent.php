<?php declare(strict_types=1);

namespace Shopware\Api\Product\Event\ProductSearchKeyword;

use Shopware\Api\Entity\Search\IdSearchResult;
use Shopware\Context\Struct\ApplicationContext;
use Shopware\Framework\Event\NestedEvent;

class ProductSearchKeywordIdSearchResultLoadedEvent extends NestedEvent
{
    public const NAME = 'product_search_keyword.id.search.result.loaded';

    /**
     * @var IdSearchResult
     */
    protected $result;

    public function __construct(IdSearchResult $result)
    {
        $this->result = $result;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): ApplicationContext
    {
        return $this->result->getContext();
    }

    public function getResult(): IdSearchResult
    {
        return $this->result;
    }
}
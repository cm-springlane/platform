<?php declare(strict_types=1);

namespace Shopware\Api\Product\Event\ProductSearchKeyword;

use Shopware\Api\Entity\Search\AggregatorResult;
use Shopware\Context\Struct\ApplicationContext;
use Shopware\Framework\Event\NestedEvent;

class ProductSearchKeywordAggregationResultLoadedEvent extends NestedEvent
{
    public const NAME = 'product_search_keyword.aggregation.result.loaded';

    /**
     * @var AggregatorResult
     */
    protected $result;

    public function __construct(AggregatorResult $result)
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

    public function getResult(): AggregatorResult
    {
        return $this->result;
    }
}
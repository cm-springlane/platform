<?php declare(strict_types=1);

namespace Shopware\Api\Customer\Event\CustomerAddress;

use Shopware\Api\Entity\Search\IdSearchResult;
use Shopware\Context\Struct\ApplicationContext;
use Shopware\Framework\Event\NestedEvent;

class CustomerAddressIdSearchResultLoadedEvent extends NestedEvent
{
    public const NAME = 'customer_address.id.search.result.loaded';

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
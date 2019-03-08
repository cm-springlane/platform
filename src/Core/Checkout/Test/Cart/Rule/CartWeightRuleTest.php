<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Test\Cart\Rule;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\Delivery\Struct\DeliveryDate;
use Shopware\Core\Checkout\Cart\Delivery\Struct\DeliveryInformation;
use Shopware\Core\Checkout\Cart\LineItem\LineItem;
use Shopware\Core\Checkout\Cart\LineItem\LineItemCollection;
use Shopware\Core\Checkout\Cart\Rule\CartRuleScope;
use Shopware\Core\Checkout\Cart\Rule\CartWeightRule;
use Shopware\Core\Checkout\CheckoutContext;
use Shopware\Core\Content\Rule\Aggregate\RuleCondition\RuleConditionEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Struct\Uuid;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;

class CartWeightRuleTest extends TestCase
{
    use IntegrationTestBehaviour;
    /**
     * @var CartWeightRule
     */
    private $rule;

    protected function setUp(): void
    {
        $this->rule = new CartWeightRule();
    }

    public function testIfMatchesCorrectOnEqualWeight(): void
    {
        $this->rule->assign(['weight' => 300, 'operator' => CartWeightRule::OPERATOR_EQ]);

        $match = $this->rule->match(new CartRuleScope(
            $this->createCartDummy(),
            $this->createMock(CheckoutContext::class)
        ));

        static::assertTrue($match->matches());
    }

    public function testIfMatchesUnequal(): void
    {
        $this->rule->assign(['weight' => 300, 'operator' => CartWeightRule::OPERATOR_NEQ]);

        $match = $this->rule->match(new CartRuleScope(
            $this->createCartDummy(),
            $this->createMock(CheckoutContext::class)
        ));

        static::assertFalse($match->matches());
    }

    public function testIfGreaterThanIsCorrect(): void
    {
        $this->rule->assign(['weight' => 300, 'operator' => CartWeightRule::OPERATOR_GT]);

        $match = $this->rule->match(new CartRuleScope(
            $this->createCartDummy(),
            $this->createMock(CheckoutContext::class)
        ));

        static::assertFalse($match->matches());

        $this->rule->assign(['weight' => 200]);

        $match = $this->rule->match(new CartRuleScope(
            $this->createCartDummy(),
            $this->createMock(CheckoutContext::class)
        ));

        static::assertTrue($match->matches());
    }

    public function testIfRuleIsConsistent(): void
    {
        $ruleId = Uuid::uuid4()->getHex();
        $context = Context::createDefaultContext();
        $ruleRepository = $this->getContainer()->get('rule.repository');
        $conditionRepository = $this->getContainer()->get('rule_condition.repository');

        $ruleRepository->create(
            [['id' => $ruleId, 'name' => 'Demo rule', 'priority' => 1]],
            Context::createDefaultContext()
        );

        $id = Uuid::uuid4()->getHex();
        $conditionRepository->create([
            [
                'id' => $id,
                'type' => (new CartWeightRule())->getName(),
                'ruleId' => $ruleId,
                'value' => [
                    'weight' => (float) 9000,
                    'operator' => CartWeightRule::OPERATOR_EQ,
                ],
            ],
        ], $context);

        /* @var RuleConditionEntity $result */
        $result = $conditionRepository->search(new Criteria([$id]), $context)->get($id);

        static::assertNotNull($result);
        static::assertEquals('9000', $result->getValue()['weight']);
        static::assertEquals(CartWeightRule::OPERATOR_EQ, $result->getValue()['operator']);
    }

    private function createCartDummy(): Cart
    {
        $cart = new Cart('test', Uuid::uuid4()->getHex());

        $lineItemCollection = new LineItemCollection();
        $lineItemCollection->add((new LineItem('dummyWithShippingCost', 'product', 3))->setDeliveryInformation(
            new DeliveryInformation(
                9999,
                50.0,
                new DeliveryDate(new \DateTime('-6h'), new \DateTime('+3 weeks')),
                new DeliveryDate(new \DateTime('-6h'), new \DateTime('+3 weeks')),
                false
            )
        ));
        $lineItemCollection->add(
            (new LineItem('dummyNoShippingCost', 'product', 3))->setDeliveryInformation(
                new DeliveryInformation(
                    9999,
                    50.0,
                    new DeliveryDate(new \DateTime('-6h'), new \DateTime('+3 weeks')),
                    new DeliveryDate(new \DateTime('-6h'), new \DateTime('+3 weeks')),
                    true
                )
            )
        );

        $cart->addLineItems($lineItemCollection);

        return $cart;
    }
}
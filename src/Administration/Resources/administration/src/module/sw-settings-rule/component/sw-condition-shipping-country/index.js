import { Component, State } from 'src/core/shopware';
import template from './sw-condition-shipping-country.html.twig';

/**
 * @public
 * @description TODO: Add description
 * @status prototype
 * @example-type code-only
 * @component-example
 * <sw-condition-shipping-country :condition="condition"></sw-condition-shipping-country>
 */
Component.extend('sw-condition-shipping-country', 'sw-condition-base', {
    template,

    computed: {
        operators() {
            return this.ruleConditionService.operatorSets.multiStore;
        },
        fieldNames() {
            return ['operator', 'identifiers'];
        },
        defaultValues() {
            return {
                operator: this.ruleConditionService.operators.isOneOf.identifier
            };
        }
    },

    methods: {
        getCountryStore() {
            return State.getStore('country');
        }
    }
});
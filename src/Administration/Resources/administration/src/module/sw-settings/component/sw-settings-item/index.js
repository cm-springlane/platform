import { Component } from 'src/core/shopware';
import template from './sw-settings-item.html.twig';

import './sw-settings-item.scss';

Component.register('sw-settings-item', {
    template,

    props: {
        label: {
            required: true,
            type: String
        },
        to: {
            required: true,
            type: Object,
            default() {
                return {};
            }
        },
        disabled: {
            required: false,
            type: Boolean,
            default: false
        }
    },

    computed: {
        classes() {
            return {
                'is--disabled': this.disabled
            };
        }
    }
});

import { Mixin } from 'src/core/shopware';
import template from './sw-media-modal-folder-dissolve.html.twig';

/**
 * @status ready
 * @description The <u>sw-media-modal-folder-dissolve</u> component is used to validate the dissolve folder action.
 * @example-type code-only
 * @component-example
 * <sw-media-modal-folder-dissolve :itemsToDissolve="[items]">
 * </sw-media-modal-folder-dissolve>
 */
export default {
    name: 'sw-media-modal-folder-dissolve',
    template,

    inject: ['mediaFolderService'],

    mixins: [
        Mixin.getByName('notification')
    ],

    props: {
        itemsToDissolve: {
            required: true,
            type: Array,
            validator(value) {
                return (value.length !== 0);
            }
        }
    },

    methods: {
        closeDissolveModal(originalDomEvent) {
            this.$emit('sw-media-modal-folder-dissolve-close', { originalDomEvent });
        },

        dissolveSelection() {
            const dissolvePromises = [];

            this.itemsToDissolve.forEach((item) => {
                item.isLoading = true;

                dissolvePromises.push(
                    this.mediaFolderService.dissolveFolder(item.id).then(() => {
                        item.isLoading = false;
                        item.remove();
                        this.createNotificationSuccess({
                            title: this.$root.$tc('global.sw-media-modal-folder-dissolve.notification.successSingle.title'),
                            message: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.successSingle.message',
                                1,
                                { folderName: item.name }
                            )
                        });
                        return item.id;
                    }).catch(() => {
                        item.isLoading = false;
                        this.createNotificationError({
                            title: this.$root.$tc('global.sw-media-modal-folder-dissolve.notification.errorSingle.title'),
                            message: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.errorSingle.message',
                                1,
                                { folderName: item.name }
                            )
                        });
                    })
                );
            });

            this.$emit(
                'sw-media-modal-folder-dissolve-items-dissolved',
                Promise.all(dissolvePromises).then((ids) => {
                    if (dissolvePromises.length > 1) {
                        this.createNotificationSuccess({
                            title: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.successOverall.title'
                            ),
                            message: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.successOverall.message'
                            )
                        });
                    }
                    return ids;
                }).catch(() => {
                    if (dissolvePromises.length > 1) {
                        this.createNotificationError({
                            title: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.errorOverall.title'
                            ),
                            message: this.$root.$tc(
                                'global.sw-media-modal-folder-dissolve.notification.errorOverall.message'
                            )
                        });
                    }
                })
            );
        }
    }
};

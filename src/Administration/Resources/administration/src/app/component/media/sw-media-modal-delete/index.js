import { Mixin, Filter } from 'src/core/shopware';
import template from './sw-media-modal-delete.html.twig';

/**
 * @status ready
 * @description The <u>sw-media-modal-delete</u> component is used to validate the delete action.
 * @example-type code-only
 * @component-example
 * <sw-media-modal-delete :itemsToDelete="[items]">
 * </sw-media-modal-delete>
 */
export default {
    name: 'sw-media-modal-delete',
    template,

    mixins: [
        Mixin.getByName('notification')
    ],

    props: {
        itemsToDelete: {
            required: true,
            type: Array,
            validator(value) {
                return (value.length !== 0);
            }
        }
    },

    data() {
        return {
            mediaItems: [],
            folders: []
        };
    },

    computed: {
        mediaNameFilter() {
            return Filter.getByName('mediaName');
        },

        snippets() {
            if (this.mediaItems.length > 0 && this.folders.length > 0) {
                return {
                    successOverall: this.$tc(
                        'global.sw-media-modal-delete.notification.successOverall.message.mediaAndFolder'
                    ),
                    errorOverall: this.$tc(
                        'global.sw-media-modal-delete.notification.errorOverall.message.mediaAndFolder'
                    ),
                    modalTitle: this.$tc('global.sw-media-modal-delete.titleModal.mediaAndFolder'),
                    deleteMessage: this.$tc(
                        'global.sw-media-modal-delete.deleteMessage.mediaAndFolder',
                        this.itemsToDelete.length,
                        {
                            mediaCount: this.mediaItems.length,
                            folderCount: this.folders.length
                        }
                    )
                };
            }

            if (this.mediaItems.length > 0) {
                return {
                    successOverall: this.$tc('global.sw-media-modal-delete.notification.successOverall.message.media'),
                    errorOverall: this.$tc('global.sw-media-modal-delete.notification.errorOverall.message.media'),
                    modalTitle: this.$tc('global.sw-media-modal-delete.titleModal.media'),
                    deleteMessage: this.$tc(
                        'global.sw-media-modal-delete.deleteMessage.media',
                        this.mediaItems.length,
                        {
                            name: this.mediaNameFilter(this.mediaItems[0]),
                            count: this.mediaItems.length
                        }
                    )
                };
            }

            return {
                successOverall: this.$tc('global.sw-media-modal-delete.notification.successOverall.message.folder'),
                errorOverall: this.$tc('global.sw-media-modal-delete.notification.errorOverall.message.folder'),
                modalTitle: this.$tc('global.sw-media-modal-delete.titleModal.folder'),
                deleteMessage: this.$tc(
                    'global.sw-media-modal-delete.deleteMessage.folder',
                    this.folders.length,
                    {
                        name: this.folders[0].name,
                        count: this.folders.length
                    }
                )
            };
        }
    },

    created() {
        this.componentCreated();
    },

    methods: {
        componentCreated() {
            this.mediaItems = this.itemsToDelete.filter((item) => {
                return item.getEntityName() === 'media';
            });
            this.folders = this.itemsToDelete.filter((item) => {
                return item.getEntityName() === 'media_folder';
            });
        },

        closeDeleteModal(originalDomEvent) {
            this.$emit('sw-media-modal-delete-close', { originalDomEvent });
        },

        deleteSelection() {
            const deletePromises = [];

            this.itemsToDelete.forEach((item) => {
                item.isLoading = true;

                deletePromises.push(
                    item.delete(true).then(() => {
                        item.isLoading = false;
                        this.createNotificationSuccess({
                            title: this.$root.$tc('global.sw-media-modal-delete.notification.successSingle.title'),
                            message: item.getEntityName() === 'media' ?
                                this.$root.$tc(
                                    'global.sw-media-modal-delete.notification.successSingle.message.media',
                                    1,
                                    { name: this.mediaNameFilter(item) }
                                ) :
                                this.$root.$tc(
                                    'global.sw-media-modal-delete.notification.successSingle.message.folder',
                                    1,
                                    { name: item.name }
                                )
                        });
                    }).catch(() => {
                        item.isLoading = false;
                        this.createNotificationError({
                            title: this.$root.$tc('global.sw-media-modal-delete.notification.errorSingle.title'),
                            message: item.getEntityName() === 'media' ?
                                this.$root.$tc(
                                    'global.sw-media-modal-delete.notification.errorSingle.message.media',
                                    1,
                                    { name: this.mediaNameFilter(item) }
                                ) :
                                this.$root.$tc(
                                    'global.sw-media-modal-delete.notification.errorSingle.message.folder',
                                    1,
                                    { name: item.name }
                                )
                        });
                    })
                );
            });

            this.$emit(
                'sw-media-modal-delete-items-deleted',
                Promise.all(deletePromises).then(() => {
                    this.createNotificationSuccess({
                        title: this.$root.$tc('global.sw-media-modal-delete.notification.successOverall.title'),
                        message: this.snippets.successOverall
                    });
                    return {
                        mediaIds: this.mediaItems.map((media) => { return media.id; }),
                        folderIds: this.folders.map((folder) => { return folder.id; })
                    };
                }).catch(() => {
                    this.createNotificationError({
                        title: this.$root.$tc('global.sw-media-modal-delete.notification.errorOverall.title'),
                        message: this.snippets.errorOverall
                    });
                })
            );
        }
    }
};

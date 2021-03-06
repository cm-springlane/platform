const productStreamPage = require('administration/page-objects/module/sw-product-stream.page-object.js');

module.exports = {
    '@tags': ['product-stream-inline-edit', 'product-stream', 'inline-edit'],
    '@disabled': !global.flags.isActive('next739'),
    before: (browser, done) => {
        global.AdminFixtureService.create('product-stream').then(() => {
            done();
        });
    },
    'navigate to product stream module': (browser) => {
        browser
            .openMainMenuEntry({
                targetPath: '#/sw/product-stream/index',
                mainMenuId: 'sw-product'
            });
    },
    'inline edit product stream name and description and verify edits': (browser) => {
        const page = productStreamPage(browser);

        browser.expect.element(`${page.elements.gridRow}--0 .sw-product-stream-list__column-name`).to.have.text.that.equals('1st product stream');

        browser
            .waitForElementVisible(`${page.elements.gridRow}--0`)
            .moveToElement(`${page.elements.gridRow}--0`, 5, 5).doubleClick()
            .waitForElementVisible('.is--inline-editing')
            .fillField('input[name=sw-field--item-name]', 'Stream it', true)
            .waitForElementVisible(page.elements.gridRowInlineEdit)
            .click(page.elements.gridRowInlineEdit)
            .waitForElementNotPresent('.is--inline-editing ')
            .refresh()
            .expect.element('.sw-grid-column.sw-grid__cell.sw-grid-column--left').to.have.text.that.contains('Stream it');
    }
};

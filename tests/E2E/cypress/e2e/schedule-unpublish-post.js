const {Given, When, Then} = require("@badeball/cypress-cucumber-preprocessor");
Given(/^I am on a published post page$/, function () {
    cy.fetchLastPost().then(post => {
        cy.editPost(post.ID)
    })
});
When(/^I add '(.*)' to the post title$/, function (text) {
    cy.get('.editor-post-title').last().type(text)
});
When(/^I save the post$/, function () {
    cy.saveCurrentPost()
});
Then(/^The post title should be saved with '(.*)'$/, function (text) {
    cy.fetchLastPost().then(post => {
        expect(post.post_title).contains(text)
    })
});
Then(/^The post should be publish$/, function () {
    cy.fetchLastPost().then(post => {
        expect(post.post_status).eq('publish')
    })
});
When(/^I schedule the post to tomorrow$/, function () {

});
Then(/^The post should be scheduled$/, function () {

});
When(/^I schedule the post to yesterday$/, function () {

});
Then(/^The post should be private$/, function () {

});
Given(/^I have (.*) post$/, function (status) {
    cy.fetchLastPost().then(post => {
        expect(post.status).eq(status)
    })
});
Then(/^I should not be able to schedule the post$/, function () {

});
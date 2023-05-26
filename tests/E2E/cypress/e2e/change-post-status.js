const {When, Given, Then} = require("@badeball/cypress-cucumber-preprocessor");
Given('I have {word} post', function (status) {
    cy.wp(`post generate --post_status=${status}`)
})

Given('I have a schedule to {word} on the post', function (status) {
    const currentDate  = new Date(); // The Date object returns today's timestamp

    currentDate.setDate(currentDate.getDate() + 1);
    const timestamp = currentDate.getTime();
    cy.addArticleSchedule(status,timestamp);
})

When('I pass the post to {word}', function (status) {
    cy.fetchLastPost().then(function (post) {
        cy.editPost(post.ID);
        if('draft' === status) {
            cy.get('button.editor-post-save-draft,button.editor-post-switch-to-draft').click()
            cy.saveCurrentPost()
            return
        }
        cy.get('button.edit-post-post-visibility__toggle').click()
        if('protected' === status) {
            cy.get(`input[value="password"].editor-post-visibility__dialog-radio`).click()

        } else {
            cy.get(`input[value="${status}"].editor-post-visibility__dialog-radio`).click()
        }
    });
})

Then('I should not have a post scheduled to {word}', function (status) {
    cy.hasArticleSchedule(status).should('be.false')
})

Then('I should have a post scheduled to {word}', function (status) {
    cy.hasArticleSchedule(status).should('be.true')
})
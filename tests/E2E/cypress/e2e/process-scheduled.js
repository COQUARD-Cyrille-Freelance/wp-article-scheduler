const {Given, When, Then} = require("@badeball/cypress-cucumber-preprocessor");

const runSeederDependingOnTime = (time, past, future) => {
    if(time === 'yesterday') {
        cy.cleanThenSeed(past)
        return;
    }
    cy.cleanThenSeed(future)
}
Given(/^I got a (.*) post scheduled to (.*) for (.*)$/, function (type, action, time) {
        if(type === 'publish') {
            runSeederDependingOnTime(time, 'PostScheduledPublishPastSeeder', 'PostScheduledPublishFutureSeeder')
        }
        if(type === 'draft') {
            runSeederDependingOnTime(time, 'PostScheduledDraftPastSeeder', 'PostScheduledDraftFutureSeeder')
        }
        if(type === 'protected') {
            runSeederDependingOnTime(time, 'PostScheduledProtectedPastSeeder', 'PostScheduledProtectedFutureSeeder')
        }
        if(type === 'private') {
            runSeederDependingOnTime(time, 'PostScheduledPrivatePastSeeder', 'PostScheduledPrivateFutureSeeder')
        }
});
When(/^I run the queue$/, function () {
    cy.wp('cron event run coquardcyr_wp_article_scheduler_process_scheduled_posts')
    cy.wp('action-scheduler run')
});
Then("I should have a post {word}", function (type) {
    cy.fetchLastPost().then(post => {
        expect(post.post_status).eq(type)
    })
});
Then(/^I should (.*) a post scheduled to unpublish$/, function (existence, status) {

    if('have' === existence.trim()) {
        cy.hasArticleSchedule('draft').should('be.true')
        return
    }
    cy.hasArticleSchedule('draft').should('not.be.true')
});
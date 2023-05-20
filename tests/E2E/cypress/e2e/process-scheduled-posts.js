const {Given, When, Then} = require("cucumber");

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
    cy.wp('wp action-scheduler run --group=coquardcyr_wp_article_scheduler')
});
Then(/^I should have a post (.*)$/, function (type) {
    const post = cy.fetchLastPost()
    expect(post.post_status).eq(type)
});
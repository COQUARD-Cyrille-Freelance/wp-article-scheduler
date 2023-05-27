// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })
import '@coquardcyr/wp-cypress/lib/cypress-support';
import "@testing-library/cypress/add-commands";

Cypress.Commands.add('fetchLastPost', () => {
    return cy.wp('post list --format=json').then(data => {
        const list = JSON.parse(data.stdout);
        if(list.length === 0) {
            return {};
        }
        return list.reduce((a,b) => a.ID > b.ID ? a : b, {ID: 0});
    })

})

Cypress.Commands.add('addArticleSchedule', (status, date) => {
    const table = 'article_schedules';
    cy.fetchLastPost().then(post => {
        const data = JSON.stringify({
            post_id: post.ID,
            status,
            change_date: date
        }).replaceAll('"','\\"');
        cy.wp(`insert-row ${table} '${data}'`);
    })
})

Cypress.Commands.add('hasArticleSchedule', (status) => {
    return cy.fetchLastPost().then(post => {
        return cy.wp("export-table article_schedules").then(data => {
            const list = JSON.parse(data.stdout);
            if(list.length === 0) {
                return false;
            }
            return list.filter((d) => d.status === status && parseInt(d.post_id) === parseInt(post.ID)).length !== 0;
        });
    })
})
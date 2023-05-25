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
import '@bigbite/wp-cypress/lib/cypress-support';
import "@testing-library/cypress/add-commands";

Cypress.Commands.add('fetchLastPost', () => {
    const list = cy.wp('post list --format=json')
    if(list.length === 0) {
        return {};
    }
    return list.pop();
})

Cypress.Commands.add('addArticleSchedule', (status, date) => {
    const table = '';
    const post = cy.fetchLastPost();
    const data = JSON.encode({
        post_id: post.ID,
        status,
        change_date: date
    });
    cy.wp(`insert-row ${table} "${data}"`);
})

Cypress.Commands.add('hasArticleSchedule', (status) => {
    const post = cy.fetchLastPost();
    const data = cy.wp("export-table");
    if(data.length === 0) {
        return false;
    }
    return data.filter((d) => d.status === status && d.post_id === post.ID).length !== 0;
})
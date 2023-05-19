const { defineConfig } = require("cypress");
const wpCypressPlugin = require('@bigbite/wp-cypress/lib/cypress-plugin');
const cucumber = require('cypress-cucumber-preprocessor').default
const createBundler = require("@bahmutov/cypress-esbuild-preprocessor");
const addCucumberPreprocessorPlugin =
    require("@badeball/cypress-cucumber-preprocessor").addCucumberPreprocessorPlugin;
const createEsbuildPlugin =
    require("@badeball/cypress-cucumber-preprocessor/esbuild").createEsbuildPlugin;


module.exports = defineConfig({
  e2e: {
    async setupNodeEvents(on, config) {
      const bundler = createBundler({
        plugins: [createEsbuildPlugin(config)],
      });

      on("file:preprocessor", bundler);
      await addCucumberPreprocessorPlugin(on, config);

      return wpCypressPlugin(on, config)
    },
    specPattern: "**/*.feature",
  },
  wp: {
    version: ["5.7"],
    plugins: ["../../"],
    phpVersion: "8.0",
    dbPort: 3304,
    port: 8888
  },
});

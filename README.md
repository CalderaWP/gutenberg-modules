# Gutenberg Modules

Gutenberg's built CSS and JavaScript as an npm package.

## Why?
* I wanted to develop Caldera Forms UI, using Gutenberg's control components and data component, in an environment that did not include WordPress.
* I want to play with Symfony Process/ Console components.

## Use In Your App

### Install
`npm i --save @caldera-labs/gutenberg-modules`

### Setup webpack
You can see my attempt to make this work in `examples/create-react-app`, which doesn't work yet.

## Build
If you want to use this repo to build your own copy:

NOTE: The version of Gutenberg to pull is hardcoded in app.php for now.

* Install 
    `git clone https://github.com/CalderaWP/gutenberg-modules/tree/master/dist/blocks`
* Switch to directory
   `cd gutenberg modules`
* Run build command
    `composer build`

### Publish To NPM
You must be authenticated as Josh for this to work.

* `composer publish`
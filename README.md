# Demo application [![CircleCI](https://circleci.com/gh/torchello/demo/tree/master.svg?style=svg)](https://circleci.com/gh/torchello/demo/tree/master) [![codecov](https://codecov.io/gh/torchello/demo/branch/master/graph/badge.svg)](https://codecov.io/gh/torchello/demo)

## Overview
The application allows to query users based on SQL-like DSL-based filter engine with a room for customization.

## What's inside
* Symfony 3
* PHP specifications (unit tests)
* Behat scenarios (functional tests)
* Custom DSL for parsing user query conditions in special format (based on [Dissect](https://github.com/clickinnovation/dissect))
* Circle CI integration
* Codecov.io integration

## Steps to run
```
git clone git@github.com:torchello/demo.git
cd demo
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load
php -S 127.0.0.1:8000 -t web
```
Open http://127.0.0.1:8000 in your browser.

## Key/representable parts of the app
* [DSL grammar](https://github.com/torchello/demo/blob/master/src/AppBundle/Resources/config/language.yml)
* [Expression Context](https://github.com/torchello/demo/blob/master/src/AppBundle/Language/Context/ExpressionContext.php)
* [Spec example](https://github.com/torchello/demo/blob/master/spec/AppBundle/Language/Context/ExpressionContextSpec.php)
* [Behat integration test example](https://github.com/torchello/demo/blob/master/src/AppBundle/Features/parser/expression_context.feature)
* [Behat feature example](https://github.com/torchello/demo/blob/master/src/AppBundle/Features/user_table.feature)


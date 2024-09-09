# Default shell
SHELL := /bin/bash

# Variables
MAKE_PHP_8_3_BIN ?= php8.3
MAKE_COMPOSER_2_BIN ?= /usr/local/bin/composer2

MAKE_PHP ?= ${MAKE_PHP_8_3_BIN}
MAKE_COMPOSER ?= ${MAKE_PHP} ${MAKE_COMPOSER_2_BIN}
MAKE_ARTISAN ?= ${MAKE_PHP} artisan

# Default goal
.DEFAULT_GOAL := panic

# Goals
.PHONY: check
check: lint stan test audit

.PHONY: audit
audit: ./vendor ./composer.lock ./node_modules ./package-lock.json
	${MAKE_COMPOSER} audit
	${MAKE_COMPOSER} check-platform-reqs
	${MAKE_COMPOSER} validate --strict --no-check-all
	npm audit --audit-level info --include prod --include dev --include peer --include optional

.PHONY: stan
stan: ./vendor/bin/phpstan
	${MAKE_PHP} ./vendor/bin/phpstan analyse

.PHONY: lint
lint: ./node_modules/.bin/prettier ./vendor/bin/php-cs-fixer ./node_modules/.bin/eslint
	./node_modules/.bin/prettier -c .
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix --dry-run --diff
	./node_modules/.bin/eslint .

.PHONY: fix
fix: ./node_modules/.bin/prettier ./vendor/bin/php-cs-fixer ./node_modules/.bin/eslint
	./node_modules/.bin/prettier -w .
	${MAKE_PHP} ./vendor/bin/php-cs-fixer fix
	./node_modules/.bin/eslint --fix .

.PHONY: test
test: ./vendor/bin/phpunit ./artisan ./bootstrap/cache/services.php ./bootstrap/cache/packages.php
	${MAKE_ARTISAN} optimize:clear --env=testing
	${MAKE_ARTISAN} test --env=testing

.PHONY: coverage
coverage: test
	php -S 0.0.0.0:8000 -t ./.phpunit.coverage/html

.PHONY: clean
clean:
	rm -rf ./node_modules
	rm -rf ./package-lock.json
	rm -rf ./vendor
	rm -rf ./composer.lock
	rm -rf ./.phpunit.result.cache
	rm -rf ./.php-cs-fixer.cache
	rm -rf ./.phpunit.cache
	rm -rf ./.phpunit.coverage

.PHONY: update
update:
	${MAKE_COMPOSER} update
	npm update --install-links --include prod --include dev --include peer --include optional

.PHONY: serve
serve: ./vendor/autoload.php ./artisan ./bootstrap/cache/services.php ./bootstrap/cache/packages.php
	${MAKE_ARTISAN} optimize:clear
	${MAKE_ARTISAN} serve --host=0.0.0.0 --port=8000

# Deploy / Release
.PHONY: local
local:
	${MAKE_COMPOSER} install
	npm install --install-links --include prod --include dev --include peer --include optional
	${MAKE_ARTISAN} optimize:clear
	${MAKE_ARTISAN} package:discover
	${MAKE_ARTISAN} vendor:publish --tag=laravel-assets --force
	${MAKE_ARTISAN} migrate --force
	${MAKE_ARTISAN} db:seed --force
	${MAKE_ARTISAN} storage:link --force
	${MAKE_ARTISAN} queue:restart

.PHONY: testing
testing: local

.PHONY: development
development: testing

.PHONY: staging
staging:
	${MAKE_COMPOSER} install
	npm install --install-links --include prod --include dev --include peer --include optional
	${MAKE_ARTISAN} optimize:clear
	${MAKE_ARTISAN} package:discover
	${MAKE_ARTISAN} vendor:publish --tag=laravel-assets --force
	${MAKE_ARTISAN} migrate --force
	${MAKE_ARTISAN} db:seed --force
	${MAKE_ARTISAN} storage:link --force
	${MAKE_COMPOSER} install -a --no-dev
	npm install --install-links --include prod --include dev --include peer --include optional
	${MAKE_ARTISAN} queue:restart

.PHONY: production
production: staging

# Dependencies
./vendor ./composer.lock ./vendor/bin/phpstan ./vendor/bin/php-cs-fixer ./vendor/bin/phpunit ./vendor/autoload.php:
	${MAKE_COMPOSER} install

./node_modules ./package-lock.json ./node_modules/.bin/prettier ./node_modules/.bin/eslint:
	npm install --install-links --include prod --include dev --include peer --include optional

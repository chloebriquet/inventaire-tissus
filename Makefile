DOCKER_DIR                = .docker
DOCKER_COMPOSE            = cd $(DOCKER_DIR) && sudo docker-compose

EXEC_APACHE_PHP_CONTAINER = ${DOCKER_DIR}/bin/docker-apache-php
ECHO                      = ${DOCKER_DIR}/bin/echo-title

NPM                       = $(EXEC_APACHE_PHP_CONTAINER) npm
SYMFONY                   = $(EXEC_APACHE_PHP_CONTAINER) bin/console

##
## Environment
## ‒‒‒‒‒‒‒‒‒‒‒
##

project-install: docker-build dev-start composer-install db-reset npm npm-dev ## Install the project and start the dev environment

project-remove: docker-kill ## Stop the dev environment and remove generated files
	$(ECHO) "Removing files"
	rm -rf vendor var node_modules

project-reinstall: project-remove project-install ## Destroy the dev environment, run a fresh install of the project, then start the dev environment

dev-start: ## Start the dev environment
	$(ECHO) "Starting docker"
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

dev-stop: ## Stop the dev environment
	$(ECHO) "Stopping docker"
	$(DOCKER_COMPOSE) down

composer-install: ## Install composer packages
	$(ECHO) "Installing Symfony vendors"
	$(EXEC_APACHE_PHP_CONTAINER) composer install

composer-update: ## Update composer packages
	$(ECHO) "Installing Symfony vendors"
	$(EXEC_APACHE_PHP_CONTAINER) composer update

##
##
## Database
## ‒‒‒‒‒‒‒‒
##

db-reset: ## Reset Symfony database with default data
	$(ECHO) "Loading Symfony database"
	$(SYMFONY) doctrine:database:drop --force --if-exists
	$(SYMFONY) doctrine:database:create
	$(SYMFONY) doctrine:schema:create
	$(ECHO) "Loading Symfony fixtures"
	$(SYMFONY) doctrine:fixtures:load --no-interaction

db-migrate: ## Run Symfony migrations
	$(ECHO) "Run Symfony migrations"
	$(SYMFONY) doctrine:migrations:migrate

##
##
## Assets
## ‒‒‒‒‒‒
##

npm: ## Update npm packages
	$(ECHO) "Installing npm"
	$(NPM) install

npm-watch: ## Watch the assets and build their development version on file change
	$(ECHO) "Watching assets changes"
	$(NPM) run watch

npm-dev: ## Build the development version of the assets
	$(ECHO) "Building dev assets"
	$(NPM) run dev

npm-prod: ## Build the production version of the assets
	$(ECHO) "Building prod assets"
	$(NPM) run build

##
##
## Quality
## ‒‒‒‒‒‒‒
##

cs-fixer: download-php-cs-fixer ## Apply php-cs-fixer
	$(ECHO) "Running php-cs-fixer"
	$(EXEC_APACHE_PHP_CONTAINER) php php-cs-fixer fix --config=.php_cs.dist -v --using-cache=no

tests: ## Run unit tests
	$(ECHO) "Running tests"
	$(EXEC_APACHE_PHP_CONTAINER) bin/phpunit

symfony-security: ## Check security of your dependencies (https://security.sensiolabs.org/)
	$(ECHO) "Checking Symfony vendor security"
	$(EXEC_APACHE_PHP_CONTAINER) ./bin/console security:check


##
##
## Debug
## ‒‒‒‒‒
##

apache-error-log: ## Display the last entries from Apache error log
	$(ECHO) "Displaying in real time last entries from Apache error log" "Use CTRL+C to close the process"
	$(EXEC_APACHE_PHP_CONTAINER) tail -f /var/log/apache2/error.log

apache-access-log: ## Display the last entries from Apache access log
	$(ECHO) "Displaying last entries from Apache access log" "Use CTRL+C to close the process"
	$(EXEC_APACHE_PHP_CONTAINER) tail -f /var/log/apache2/access.log

##
#
# Internal rules
# ‒‒‒‒‒‒‒‒‒‒‒‒‒‒
#

docker-build:
	$(ECHO) "Building docker"
	$(DOCKER_COMPOSE) build --pull

docker-kill:
	$(ECHO) "Killing docker"
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

download-php-cs-fixer:
	$(ECHO) "Downloading php-cs-fixer"
	$(EXEC_APACHE_PHP_CONTAINER) curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o php-cs-fixer

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[94m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[94m##/[91m/'

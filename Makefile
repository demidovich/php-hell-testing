.DEFAULT_GOAL := help

export UID := $(shell id -u)
export GID := $(shell id -g)

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Build application
	@echo ${UID}
	@echo ${GID}
	docker build --tag hell-testing .

vendor: build ## Install vendor
	cd "$(dirname "$0")" && docker run --rm -v `pwd`/:/app --network host hell-testing composer install

test: vendor ## Test application
	cd "$(dirname "$0")" && docker run --rm -v `pwd`/:/app hell-testing php /app/vendor/bin/phpunit

php: build ## Shell of php container
	cd "$(dirname "$0")" && docker run -ti --rm -v `pwd`/:/app --network host hell-testing sh

default: help

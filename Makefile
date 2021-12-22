.PHONY: all check build deploy build-script deploy-script config config-script clean

all: check

check:
	@if [ ! -d vendor/vinlaurens ]; then echo "No deploy scripts found. Please run composer install"; fi

build: check build-script

deploy: check deploy-script

config: check config-script

clean:
	rm -rf build/

config-script:
	cp vendor/vinlaurens/deploy-scripts/deploy.ini.default config/deploy.ini

build-script:
	vendor/vinlaurens/deploy-scripts/build.sh

deploy-script:
	vendor/vinlaurens/deploy-scripts/deploy.sh

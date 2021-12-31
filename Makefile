.PHONY: all check build deploy deploy-bsd build-script deploy-script deploy-bsd-script config config-script clean

all: check

check:
	@if [ ! -d vendor/vinlaurens ]; then echo "No deploy scripts found. Please run composer install"; fi

build: check build-script

deploy: check deploy-script

deploy-bsd: check deploy-bsd-script

config: check config-script

clean:
	rm -rf build/

config-script:
	cp vendor/vinlaurens/deploy-scripts/deploy.ini.default config/deploy.ini

build-script:
	vendor/vinlaurens/deploy-scripts/build.sh

deploy-script:
	vendor/vinlaurens/deploy-scripts/deploy.sh

deploy-bsd-script:
	vendor/vinlaurens/deploy-scripts/deploy_bsd.sh

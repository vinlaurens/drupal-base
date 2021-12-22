# vinlaurens Drupal Base

Drupal base for starting new projects.


<!-- MarkdownTOC -->

- INSTALL
    - Download the project.
- USED MODULES
        - Require
        - Require development
- UP FOR REVIEW
- UP FOR REVIEW DEV
- SECURITY UP FOR REVIEW
- PERFORMANCE UP FOR REVIEW
- DOCUMENTATION
    - Tools
    - MKDocs
    - Installation
    - Run server

<!-- /MarkdownTOC -->


INSTALL
---------

### Download the project.
1. To start a fresh project execute the following command.
```composer create-project vinlaurens/drupal-base:dev-master some-dir --no-interaction```

### Install the project.

1. Create MySQL database named: vm_drupal_base
2. Execute the following drush command.
```vendor/bin/drush site-install --account-name=admin --account-pass=admin --account-mail=noreply@local.local --site-mail=admin@dev.drupal.test --existing-config -y -vvv```
3. Remove composer.lock from the .gitignore file

### Build and deploy the project

1. Make sure "composer install" has been run.
2. Run "make config". A file will be created in "config/deploy.ini"
3. Edit "config/deploy.ini" and update ACCEPTANCE and PRODUCTION servers with respective IPs. Make sure the other data is correct.
4. Run "make build".
5. Run "make deploy".

USED MODULES
----------

#### Require

* https://www.drupal.org/project/admin_toolbar
* https://www.drupal.org/project/entity_usage
* https://www.drupal.org/project/search_api
* https://www.drupal.org/project/facets
* https://www.drupal.org/project/field_group
* https://www.drupal.org/project/hook_event_dispatcher
* https://www.drupal.org/project/paragraphs
* https://www.drupal.org/project/remote_stream_wrapper
* https://www.drupal.org/project/smart_trim
* https://www.drupal.org/project/token
* https://www.drupal.org/project/token_filter
* https://www.drupal.org/project/twig_tweak
* https://www.drupal.org/project/remote_stream_wrapper
* https://www.drupal.org/project/twig_tweak

#### Require development


* https://www.drupal.org/project/coder
* https://www.drupal.org/project/devel
* https://www.drupal.org/reroute_email/
* https://www.drupal.org/stage_file_proxy/
* https://github.com/drush-ops/drush
* https://github.com/Roave/SecurityAdvisories
* https://gitlab.com/weitzman/drupal-test-traits

UP FOR REVIEW
-------------

* https://www.drupal.org/project/twigsuggest
* https://www.drupal.org/project/views_extras
* https://www.drupal.org/project/graphql
* https://www.drupal.org/project/entity_reference_unpublished
* https://www.drupal.org/project/layout_paragraphs
* https://www.drupal.org/project/entity_reference_facet_link
* https://www.drupal.org/project/entity_reference_revisions
* https://www.drupal.org/project/dynamic_entity_reference
* https://www.drupal.org/project/twig_field_value
* https://www.drupal.org/project/field_group_table
* https://www.drupal.org/project/grouped_checkboxes
* https://www.drupal.org/project/field_group_easy_responsive_tabs
* https://www.drupal.org/project/popup_field_group
* https://www.drupal.org/project/twig_backlink
* https://www.drupal.org/project/responsive_preview
* https://www.drupal.org/project/maintenance_mode_redirect
* https://www.drupal.org/project/role_expose
* https://www.drupal.org/project/heading

UP FOR REVIEW DEV
-----------------

* https://www.drupal.org/project/erd
* https://www.drupal.org/project/twig_vardumper
* https://www.drupal.org/project/twig_debugger
* https://www.drupal.org/project/role_test_accounts
* https://www.drupal.org/project/token_environment
* https://www.drupal.org/project/phpstorm_metadata
* https://www.drupal.org/project/module_config_delete
* https://www.drupal.org/project/services_env_parameter

SECURITY UP FOR REVIEW
-----------------------
* https://www.drupal.org/project/watchdog_mailer
* https://www.drupal.org/project/env_dependencies


PERFORMANCE UP FOR REVIEW
-------------------------
* https://www.drupal.org/project/refreshless

DOCUMENTATION
-------------

### Tools
* [Markdown](https://daringfireball.net/projects/markdown/)
* [MKDocs](https://www.mkdocs.org/#installation)

### MKDocs
### Installation
1. First install MKDocs on your computer `pip install mkdocs`

### Run server
MkDocs comes with a built-in dev-server that lets you preview your documentation as you work on it.

1. Make sure you’re in the same directory as the mkdocs.yml configuration file.
2. Start the server by running  `$ mkdocs serve`
3. Open up http://127.0.0.1:8000/ in your browser

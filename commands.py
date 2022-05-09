install_plugins = 'docker exec automationmonkey_latest bash -c "php bin/console mautic:plugins:install"'
clear_cache = 'docker exec automationmonkey_latest bash -c "bin/console cache:clear --env=prod"'
copy_beefree_bundle = \
    'docker cp MauticBeefreeBundle/ automationmonkey_latest:/var/www/html/plugins/MauticBeefreeBundle/'
copy_email_type_form = \
    'docker cp EmailType.php automationmonkey_latest:/var/www/html/app/bundles/EmailBundle/Form/Type/EmailType.php'
copy_page_type_form = \
    'docker cp PageType.php automationmonkey_latest:/var/www/html/app/bundles/PageBundle/Form/Type/PageType.php'
reload_plugins = 'docker exec automationmonkey_latest bash -c "bin/console mautic:plugins:reload"'
db_bash = 'docker exec -it mauticdb_test bash -l'
sql_query_config_beefree_bundle = 'docker exec -i mauticdb_test mysql -uroot -pmysecret mautic < ./script.sql'
schema_update = 'docker exec automationmonkey_latest bash -c "php bin/console doctrine:schema:update --force"'
chown = 'docker exec automationmonkey_latest bash -c "chown -R www-data:www-data /var/www/html"'

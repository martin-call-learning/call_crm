# CALL CRM

[![PHPUnit Tests](https://github.com/martin-call-learning/call_crm/workflows/PHPUnit%20Tests/badge.svg)](https://github.com/martin-call-learning/call_crm/actions/workflows/phpunit.yml)

## Set up the database
```bash 
php bin/console doctrine:database:drop --force

php bin/console doctrine:schema:create
```
## Set up the test database
```bash
# Create the test database.
php bin/console --env=test doctrine:database:create

# Create the tables/columns in the test database
php bin/console --env=test doctrine:schema:create

composer require --dev dama/doctrine-test-bundle
```

## Connect to database
```bash
sqlite3 var/data/data.db
```

## If ```manifest.json``` is missing
Just run :
```bash 
npm install
npm run dev
```

## Bugs & Todos

1. Todo : Find a way to make the symfony console work with ```make:registration-form``` command in order to develop registration system
2. Bug : The findNotDeleted method returns good values but it's not working with forms 
    > Check ```src/Controller/Admin/AbstractCrudEntityController::createIndexQueryBuilder``` and the association fields in configureFields method in FunderController, FormationAction, etc...)
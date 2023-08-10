# CALL CRM

## Set up the database
```bash 
php bin/console doctrine:database:drop --force
```
```bash
php bin/console doctrine:schema:create
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

1. Todo : Add the possibility to enter the name of the formation to get formation id when creating or modifying formation action.
2. Todo : Find a way to make the symfony console work with ```make:registration-form``` command in order to develop registration system

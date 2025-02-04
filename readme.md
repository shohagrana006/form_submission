# Form_submission project


## Instructions:

### Open your terminal and run
- `git clone https://github.com/shohagrana006/form_submission.git`
- `cd form_submission`
- `composer install`
- `cp .env.example .env`
- go to .env file and change your database credential.


### DB setup:
    method 1: 
        - go to mysql(ui phpmyadmin) and create database name 'form_submission'
        - import form_submission.sql db file form 'form_submission/db'.
    
    or, method 2: 
        - run `mysql -u root -p < db/database.sql` from project root. 
        - give your database password.


#### Now browse the 'localhost/{project_name}'
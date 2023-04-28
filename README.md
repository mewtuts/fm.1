# HOW TO RUN THE SYSTEM

## METHOD 1

### Just follow the instructions below:

1. Install Git, XAMPP, node.js and Composer.

2. Run CMD or Git, to create a new directory to hold system files. Make sure you are in the path of your created directory and run all the commands below :

        2.1. git clone --branch master https://github.com/mewtuts/fm.1.git

        2.2. cd fm.1 (take note, the fm.1 is the name of the directory you have cloned)

        2.3. composer update

        2.4. npm update

        2.5. cp .env.example .env

        2.6. php artisan key:generate

        2.7. php artisan migrate (take note, if you see a yes/no in your terminal, just enter "yes" to create your system database. if the database already exists in your database run the "php artisan migrate:reset" first, before you run the "php artisan migrate".)

        2.8. npm run dev (take note, after you run this command open a new terminal and run again step #2.2)

        2.9. php artisan serve (take note, after running this command, copy only the given localhost and paste it in your browser.)
  
  ### THAT'S IT!. :)
 
 ## METHOD 2
 
 

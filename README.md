HOW TO RUN THE SYSTEM

Just follow the instructions below:

1. Install XAMPP, node.js, Composer and any kind of code editor platform on your computer/device. "Visual Studio Code" is most recommended.

2. Open your code editor, to create a new directory to hold system files. 
  
3. Open your terminal, just make sure you are in the path of your created directory and run all the commands below.

  3.1. git clone --branch master https://github.com/mewtuts/fm.1.git
  3.2. cd fm.1 (take note, the fm.1 is the name of the directory you have cloned)
  3.3. composer update
  3.4. npm update
  3.5. cp .env.example .env
  3.6. php artisan key:generate
  3.7. php artisan migrate (take note, if you see a yes/no in your terminal, just enter "yes" to create your system database. if the database already exists in your database run the "php artisan migrate:reset" first, before you run the "php artisan migrate".)
  3.8. npm run dev (take note, after you run this command open a new terminal and run again steo #3.2.)
  3.9. php artisan serve (take note, after running this command, copy only the given localhost and paste it in your browser.)
  
  THAT'S IT!. :)

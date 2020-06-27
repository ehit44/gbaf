# Extranet GBAF

Project realized as part of the training **Initiation Full Stack** provided by **Openclassroom**.
The goal is to code the extranet website of  **Groupement Banque-Assurance Français (GBAF)**.

## Installation
Clone the project
``` bash
$ git clone https://github.com/ehit44/gbaf.git
```

install dependencies
``` bash
$ composer install
``` 
Install the database from the files in : [sql](SQL)

Move to the folder and install the webserver with :
``` bash
$ cd gbaf
$ php -S localhost:8000 -t public/
``` 

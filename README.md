# Extranet GBAF

Project realized as part of the training **Initiation Full Stack** provided by **Openclassroom**.
The goal is to code the extranet website of  **Groupement Banque-Assurance Français (GBAF)**.

## Installation
Clone the project
``` bash
$ git clone https://github.com/ehit44/gbaf.git
```

Install dependencies
``` bash
$ composer install
``` 
Install the database from the files in [sql](https://github.com/ehit44/gbaf/tree/dev/sql) with the following order :
 1. [db](https://github.com/ehit44/gbaf/tree/dev/sql/db)
 2. [account](https://github.com/ehit44/gbaf/tree/dev/sql/account) & [acteur](https://github.com/ehit44/gbaf/tree/dev/sql/acteur)
 3. [post](https://github.com/ehit44/gbaf/tree/dev/sql/post) & [vote](https://github.com/ehit44/gbaf/tree/dev/sql/vote)

Move to the folder and install the webserver with :
``` bash
$ cd gbaf
$ php -S localhost:8000 -t public/
``` 

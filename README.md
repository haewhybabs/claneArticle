# ClaneArticle
    
    
## Installation
follow the following commands to get it started:

* git clone https://github.com/haewhybabs/claneArticle.git
* cd ./claneArticle
* docker run --rm -v $(pwd):/app composer install
* sudo chown -R $USER:$USER ../claneArticle
(remember to create and update the environmental variables from the `.env.example` file)
* docker-compose up -d
* docker-compose exec db bash
* GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';
* FLUSH PRIVILEGES;
* EXIT;
* exit
* docker-compose exec app php artisan migrate
* docker-compose exec app php artisan passport:install

## Documentation
There are 9 endppoints for the API

* **Register** : post request to;   /register , with **name,email, and password** are required for the input post

*  **Login :** post request to ; "/login , with **email** and **password** are required for the input post

* **Create Article :** post request to ; /articles . Authetication is required.  **title and body** are required for the input post

* **Get Article :** get  request to ; /articles/{id}  

* **List Articles :** get request to ; /articles

* **Update Articles :** put request to ; /articles/{id}. Authentication is required . **title,body** are required for the request. Raw data is used for the request such as
{
	"title": "THis is the title",
	"body": "THis is the body"
}

* **Delete Articles :** delelete request to ; /articles/{id}. Authentication is required. 

* **Rate Article :** post request to ; /articles/{id}/rating. **article_id, rating** are required for the input post. Such that,rating input post is between (1-10)

* **Search Article:** get request to ; /search/articles. ** search** is required for the input post.


**Note ,** Any route that requires authentication, token generated from login is copied to the route header such as the key:Authoriztion and value: Bearer token copied



#### PostMan Collection link
https://www.getpostman.com/collections/0aff73fe3cbcabb7b2ab

## Author
**Ayobami Babalola**



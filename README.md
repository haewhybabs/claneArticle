# claneArticle
    
    
## Installation
follow the following commands to get it started:

* git clone https://github.com/haewhybabs/claneArticle.git
* laradock was used to set up docker, docker-compose.yml can be found inside laradock 

## Documentation
There are 8 endppoints for the API

* **Register** : post request to;   /register , with **name,email, and password** are required for the input post

*  **Login :** post request to ; "/login , with **email** and **password** are required for the input post

* **Create Article :** post request to ; /articles . Authetication is required.  **uploaded_by,title and body** are required for the input post

* *Get Article :** get  request to ; /articles/{id} . 

* **List Articles :** get request to ; /articles . 


**Note ,** Any route that requires authentication, token generated from login is copied to the route header such as the key:Authoriztion and value:token copied



#### PostMan Collection link
https://www.getpostman.com/collections/7971a847efddd96251e6

## Author
**Ayobami Babalola**



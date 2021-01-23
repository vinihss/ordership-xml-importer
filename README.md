
# ordership-xml-importer

**Start containers**
docker-compose up -d

**init application**
*Enter in container with the command:*
 - docker-compose exec php-fpm bash

*Inside container run these commands:*

 - composer install; 
 - php artisan config:cache
 - php artisan migrate 
 - php artisan test --env=testing
 - npm install
 - npm run dev
 

*URL app:* http://localhost:8080

**Create a User**
POST /api/register

     {
        "name": "test",
        "email": "test@test.com.br",
        "password" : "123456"
     }

 
**Authenticate API**

POST http://localhost:8080/api/login

     {
        "email": "test2@test.com.br",
        "password" : "123"
     }

Will be return the token authentication:

    {
        "status": "success",
        "login": true,
        "token": "1|rlF2wk1MbGhsCIGVC7v5olBtGhK2WJznUXnfQQsI",
        "data": {
            "id": 3,
            "name": "test",
            "email": "test2@test.com.br",
            "email_verified_at": null,
            "created_at": "2021-01-22T22:46:41.000000Z",
            "updated_at": "2021-01-22T22:46:41.000000Z"
        }
    }

To use GET endpoints you must add the token on headers:

Authorization: Bearer <Token>


**GET Enpoints** 

GET api/person -> list people
GET api/person/{id} -> get a person information
GET api/ship-order -> get all orders
GET api/ship-order/{id} -> get a single order

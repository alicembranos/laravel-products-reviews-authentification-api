# Product Review Atuhorization API

## Introduction
Product Review is a Laravel powered API that allows users to add, view, update and delete products. Users will also be able to rate and review a product.
## Application Features
* User can signup and signin
* User can add and view products
* User can update or delete his product
* User can add reviews for a product
* User can update or delete his review

## API Endpoints
Method | Route | Description
--- | --- | ---
`POST` | `/api/auth/register` | Create a user
`POST` | `/api/auth/login` | Login an already registered user
`GET` | `/api/products` | View all products
`GET` | `/api/products/:id` | View a single product
`POST` | `/api/products/:id` | Create a product
`PUT` | `/api/products/:id` | Update a product 
`DELETE` | `/api/products/:id` | Delete a product 
`POST` | `/api/products/:productId/reviews` | Create a review for a product
`PUT` | `/api/products/:productId/reviews/:reviewId` | Update a product review
`DELETE` | `/api/products/:productId/reviews/:reviewId` | Delete a product review

To see all the API Endpoints run below command in your terminal

```
php artisan route:list
```

## Setup
 
```
    $ git clone https://github.com/alicembranos/laravel-products-reviews-authentification-api.git
    $ cd laravel-products-reviews-authentification-api
    $ composer install
```
  - Duplicate and save .env.example as .env and fill in environment variables
    ```
    $ php artisan migrate
    ```
  ### Run The Service
  ```
  $ php artisan serve
  ```

## Author
[Alicia Cembranos]([https://dinushchathurya.github.io/](https://github.com/alicembranos))

## License

MIT

## Design
### Database
First, I need to create database. I know, that I have next entities:
1) Customers
2) Goods
3) Loyalty cards
4) Orders

I can convert relations of Goods ond Orders into 2NF using decomposition. So I create new table
orders_to_goods with composite index (order_id, good_id), because we can't have two same goods in one
order. We only can change count of it.

In the assignment it was written that one Loyalty card can have one owner, but it was not said that one user
can only have one card, so I add ```customer_id``` column to Loyalty card, and set up foreign key to 
its owner.

### Code
I create my own implementation of MVC with extra features like simple query builder, (Yes, it's not safe,
but the task was not in writing a framework:)), Entities and UseCases.

### Requirements: 
```
php >= 8.1
MariaDB >= 10.4
Nginx
```

### Install
1) You need set up your nginx server to redirect all requests to  ```public/index.php```
2) In ```public/index.php``` change constant ROOT to your path to root of the project. Important! Slash on end
```php
// Windows
const ROOT = 'D:\OpenServer\domains\cortex-test\\';
// Linux
const ROOT = '/var/www/default/';
```
3) Copy env.example.php to env.php and setup your configurations
4) Import database from cortex.sql
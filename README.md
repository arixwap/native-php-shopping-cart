# Native PHP Shopping Cart
![Simple Google Chart](https://raw.githubusercontent.com/arixwap/native-php-shopping-cart/master/public/images/example.png)

## How To Install
- Run well in **PHP 7.1**
- Import MySql database, file location: `.files/native_php_shopping_cart.sql`
- Set config in **`index.php`**, `'baseurl' => 'http://YOUR-HOST-NAME'`
- Config your database connection in **`index.php`**
- All Set Up !

## Available Feature (27 Aug 2019)
- Create, Edit and Delete Product with Images
- Create, Edit and Delete Product Category
- Add, Edit Amount and Delete Product Item to Cart
- Checkout Cart
- Order List and Detail

## Directory Structure
- **app** : main aplication class
- **public** : assets, images and etc public access
- **system** : core PHP system, class bootloader, additional function
- **view** : output file in HTML

## Improvement :
- Setup SQLite and .env
- Home :
  - Filter Category & Search
  - Product Detail Page
- Admin :
  - Product Filter Category
  - Desription Tooltip
  - Nested Category
- System :
 - Router Class : Define constructor in App/ClassController, force to index or error 404 if method not exist
 - Input Request Validation
 - Database Class Query Builder

---

## Feel useful with this code? You can treat me some coffee here
- https://www.buymeacoffee.com/arixwap
- https://saweria.co/arixwap

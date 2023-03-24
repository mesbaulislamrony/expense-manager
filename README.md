## Expense Manager

Design of an expense manager feature.

## Tools & Technologies
![PHP](https://img.shields.io/static/v1?label=PHP&message=^8.1&color=blue)
![Laravel](https://img.shields.io/static/v1?label=Laravel&message=^10.0&color=red)
![JSON Web Tokens](https://img.shields.io/static/v1?label=JWT&message=^2.0&color=yellow)


## Run Locally

Clone the project
```bash
git clone https://github.com/mesbaulislamrony/expense-manager.git
```  

Go to the project directory
```bash
cd expense-manager
```

Install dependencies
```bash
composer update
```

Setup environment variables to .env file
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Generate application key
```bash
php artisan key:generate
```

Migration database
```bash
php artisan migrate
```

Seeding demo data
```bash
php artisan db:seed
```
**_NOTE : if you run seed command, your default password id `password`_**

Start the server
```bash
  php artisan serve
```

Open it a browser or postman
```bash
  http://127.0.0.1:8000
```

## API Reference

#### Login `Accept application/json`
```http
POST http://127.0.0.1:8000/api/login
```

| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `email` | `string` | Required |
| `password` | `string` | Required |

#### Register `Accept application/json`
```http
POST http://127.0.0.1:8000/api/register
```

| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `name` | `string` | Required |
| `email` | `string` | Required |
| `password` | `string` | Required |


### Categories

#### Index `Accept application/json`
```http
GET http://127.0.0.1:8000/api/categories
```

#### Create `Accept application/json`
```http
POST http://127.0.0.1:8000/api/categories
```
| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `name` | `string` | Required |
| `url` | `string` |  |

#### Show `Accept application/json`
```http
GET http://127.0.0.1:8000/api/categories/{id}
```

#### Update `Accept application/json`
```http
PUT http://127.0.0.1:8000/api/categories/{id}
```
| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `name` | `string` | Required |
| `url` | `string` |  |

#### Delete `Accept application/json`
```http
DELETE http://127.0.0.1:8000/api/categories/{id}
```


### Expenses

#### Index `Accept application/json`
```http
GET http://127.0.0.1:8000/api/expenses
```

#### Create `Accept application/json`
```http
POST http://127.0.0.1:8000/api/expenses
```
| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `expense_category_id` | `numeric` | Required |
| `amount` | `numeric` | Required |
| `note` | `string` |  |

#### Show `Accept application/json`
```http
GET http://127.0.0.1:8000/api/expenses/{id}
```

#### Update `Accept application/json`
```http
PUT http://127.0.0.1:8000/api/expenses/{id}
```
| Key | Value     | Description                |
| :-------- | :------- | :-------------------- |
| `expense_category_id` | `numeric` | Required |
| `amount` | `numeric` | Required |
| `note` | `string` |  |

#### Delete `Accept application/json`
```http
DELETE http://127.0.0.1:8000/api/expenses/{id}
```
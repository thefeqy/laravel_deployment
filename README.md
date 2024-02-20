<p align="center"><a href="https://laravel.com" target="_blank"><img src="/public/assets/logo.png" width="400" alt="Laravel Logo"></a></p>

## ConvertedIn Fullstack task

I am writing to express my sincere gratitude for the opportunity to complete this technical task you provided. It was truly enriching to delve into the intricacies of the assignment and to apply my skills and knowledge to solve the challenges presented.

### Installation

First, you should clone my GitHub repository by running this command:
```
  git clone https://github.com/thefeqy/convertedin_task
```

After cloning the project, you need to install application dependencies with the following commands:

```
  $ composer install
  $ npm install
```

now, you can initialize the application with one single custom command:

```php
  php artisan project:init 
```
this command will ask you to specify some environment information and you will be good to go.

You can create database using artisan command as follow: `1st requirement`

```
  php artisan db:create
```
> [!WARNING]  
> Note: you need to have a correct databse conncetion to perform the previous command

### Migrations

After setting up your database credentials, you can run this command which will run the database migrations and create Essential Users: (100 admins, 10000 users)

```php
  php artisan migrate --seed
```

### Run Application
You need to run the application with the typical command: 
```php
  php artisan serve
```

To compile javascript assets, you can run this command:

```javascript
  npm run dev
```


### Queues

You can enable real-time functionality which is used in the statistics table by running the following command:

```php
  php artisan queue:work
```

Now, you can visit `http://localhost:8000` to review the task.

> [!NOTE]  
> Note: The first admin credential is: [email: admin@admin.dev, password: 123456789]

## Test

To run the application tests you can run the following command: 

```php
  php artisan test
OR
  vendor/bin/phpunit
```

> [!NOTE]  
> Note: you can find the logs for the time spent on almost every task in the `todo.md` file.

Best regards,

Thank you.
- Muhammed Elfeqy
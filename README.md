# Packt Book Application

## About App

This is a custom web app designed for aspire. This is a test app, which includes basic functionality to manage book application.

### Features

- It is made using laravel 9.
- I have used admin lte template for admin panel.
- I have used jQuery and bootstrap 5 for front end.
- I have attached postman collection for api.

## Steps to install the web app

1. After clone or download the app, go to application folder using terminal or cmd and run this command **composer
   install**.
2. Create virtual domain to access this application and add path to public directory. Here I have made domain named assignment.local, and I can
   access that using http://assignment.local/
3. Rename .env.dev file in root with .env.
4. Change database and app url in **.env** file.
5. Now run this command **php artisan migrate --seed**. This will create all necessary tables in database and add some data in it. I have used fakerapi to import dummy book data.
6. Import postman collection and environment variable attached in **postman collection** directory.
7. You need to replace **API_URL** with your application's api url. For me, it is **http://assignment.local/api/v1/**
8. **'/admin'** is the url to access admin panel. Once you logged in with admin role you can create, update or delete the books.


## Generated users

#####

#### Admin user

    email: admin@admin.com
    password: admin@123

#### End user

    email: dhananjaykyada@gmail.com
    password: password

###

### Contact Developer

- **[Dhananjay Kyada](dhananjaykyada@gmail.com)**
- **Phone number: +91 8866298615**

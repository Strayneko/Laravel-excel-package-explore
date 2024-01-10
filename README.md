# How To Install

#### 1. Clone Project Repository
```bash
$ git clone https://github.com/Strayneko/Laravel-excel-package-explore
```
```bash
$ cd Laravel-excel-pacakge-explore
```

#### 2. Setup environment variables
```bash
$ cp .env.example .env
```

```dotenv
DB_CONNECTION=mysql
DB_HOST=host
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=root
DB_PASSWORD=password
```
#### 3. Install composer dependencies
```bash
$ composer install
```
#### 4. Install node dependencies
- NPM
```bash
$ npm install 
```
- Yarn
```bash
$ yarn
```
#### 5. Generate App key
```bash
$ php artisan:key generate
```
#### 6. Migrate & seeding database
```bash
$ php artisan migrate
```
```bash
$ php artisan db:seed
```
#### 7. Start local development server
```bash
$ php artisan serve
```
#### 8. Start local vite server
- NPM
```bash
$ npm run dev
```
- Yarn
```bash
$ yarn dev
```

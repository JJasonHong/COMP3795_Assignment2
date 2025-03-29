JGB Blog - Web & Mobile Development Project
Overview
This project consists of a full-stack blog application built with Laravel (backend) and React (frontend). The JGB Blog allows users to view articles, create new posts, and filter content by date range with infinite scrolling functionality.

Project Structure
COMP3795_Assignment2/ ├── assignment2_laravel/ # Laravel backend API └── assignment2_react/ # React frontend application

Requirements
PHP 8.1 or higher
Composer
Node.js 16+ and npm
MySQL or SQLite
Backend Setup (Laravel)
Install Dependencies
cd assignment2_laravel composer install

Environment Configuration
cp .env.example .env php artisan key:generate

Edit the .env file to configure your database connection: DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=jgb_blog DB_USERNAME=root DB_PASSWORD=

Database Setup
php artisan migrate

To seed the database with sample data: php artisan db:seed

Run Backend Server
If you do not have vite installed run npm run build first*
php artisan serve

The backend will run at http://127.0.0.1:8000

Frontend Setup (React)
Install Dependencies
cd assignment2_react npm install

Configuration
Create a src/config.ts file with your API endpoint configuration: const Config = { API_BASE_URL: 'http://127.0.0.1:8000/api' };

export default Config;

Run Development Server
npm run dev

The frontend will run at http://localhost:5173

Features
Backend (Laravel)
RESTful API for article management
User authentication and authorization
Admin dashboard for user management
Date range filtering for article visibility
Frontend (React)
Responsive UI using Bootstrap
Infinite scrolling for article listing
Article creation and viewing
Dynamic date filtering
API Endpoints
Articles
GET /api/articles - Get all articles
GET /api/articles/{id} - Get a specific article
POST /api/articles - Create a new article
PUT /api/articles/{id} - Update an article
DELETE /api/articles/{id} - Delete an article
Users
GET /api/users - Get all users (admin only)
POST /api/login - User login
POST /api/register - User registration
Admin Dashboard
Access the admin dashboard at /admin to:

View all registered users
Approve/revoke user access
Change user roles
Delete user accounts
Project Components
React Components
HomePage - Main page displaying articles with sidebars
PostsList - Displays articles with infinite scrolling
BlogPostPage - Individual article view
CreatePostPage - Form for creating new articles
NavBar - Application header with navigation
LeftSidebar - Navigation links and popular tags
RightSidebar - Trending articles and newsletter signup
Laravel Models
User - User authentication and management
Article - Blog post data management
Development Notes
CORS Configuration
The Laravel backend is configured to accept requests from the React frontend. If you're running the frontend on a different port, update the CORS configuration in config/cors.php.

Authentication
For testing purposes, authentication middleware has been temporarily disabled on the admin routes. Re-enable it for production by uncommenting the middleware lines in routes/web.php.

Deployment
Laravel Backend
To deploy the Laravel application: cd assignment2_laravel php artisan optimize php artisan route:cache php artisan config:cache

React Frontend
To build the React application for production: cd assignment2_react npm run build

Deploy the contents of the dist directory to your web server.

Contributors
JGB Team Members
                    Gem Sha A01345766
                    Brian Diep A00959233
                    Jason Hong A01232139
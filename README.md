# Task Manager 📝🚀  

Task Manager is a **Laravel-based web application** that helps users efficiently manage their tasks.  
It includes **authentication, task management with CRUD operations, status filtering, pagination,** and **AJAX-powered infinite scrolling**.  

---

## 📌 Features  

### ✅ Authentication System  
- Users can **register, log in, and log out** securely.  
- Middleware (`auth`) ensures only authenticated users can access tasks.  

### ✅ Task Management  
- **CRUD Operations**: Users can **create, edit, update, and delete** tasks.  
- **Status Updates**: Tasks can be marked as **pending, in progress, or completed**.  
- **Validation**: Ensures valid inputs (e.g., due dates must be today or later).  

### ✅ Pagination & Filtering  
- **Tasks are paginated (4 per page)** for better user experience.  
- Users can **filter tasks by status** (`pending, in progress, completed`).  

### ✅ AJAX & Infinite Scroll  
- Instead of traditional pagination, tasks **load dynamically** when scrolling.  
- **AJAX requests** fetch the next set of tasks **without reloading the page**.  

---

## 🛠️ Tech Stack  
- **Backend**: Laravel 9.52.20, MySQL  
- **Frontend**: Bootstrap 5, jQuery, AJAX, Quill.js  
- **Authentication**: Laravel’s Auth Middleware  
- **Deployment**: GitHub (for version control), optional deployment on Laravel Forge/Vercel  

---

## 🚀 Installation & Setup  

```sh
# Clone the repository and navigate to the project directory
git clone https://github.com/chankey-pal/laravel_task.git
cd laravel_task

# Install backend and frontend dependencies
composer install
npm install

# Setup environment file
cp .env.example .env

# Configure database connection in .env
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seed data
php artisan migrate --seed

# Start the development server
php artisan serve

Task Manager 📝🚀
Task Manager is a Laravel-based web application that helps users efficiently manage their tasks. It includes authentication, task management with CRUD operations, status filtering, pagination, and AJAX-powered infinite scrolling.

📌 Features
✅ Authentication System
Users can register, log in, and log out securely.

Middleware (auth) ensures only authenticated users can access tasks.

✅ Task Management
CRUD Operations: Users can create, edit, update, and delete tasks.

Status Updates: Tasks can be marked as pending, in progress, or completed.

Validation: Ensures valid inputs (e.g., due dates must be today or later).

✅ Pagination & Filtering
Tasks are paginated (4 per page) for better user experience.

Users can filter tasks by status (pending, in progress, completed).

✅ AJAX & Infinite Scroll
Instead of traditional pagination, tasks load dynamically when scrolling.

AJAX requests fetch the next set of tasks without reloading the page.

🛠️ Tech Stack
Backend: Laravel 9.52.20, MySQL

Frontend: Bootstrap 5, jQuery, AJAX, Quill.js

Authentication: Laravel’s Auth Middleware

Deployment: GitHub (for version control), optional deployment on Laravel Forge/Vercel

🚀 Installation & Setup
1️⃣ Clone the Repository
sh
Copy
Edit
git clone https://github.com/chankey-pal/laravel_task.git
cd laravel_task
2️⃣ Install Dependencies
sh
Copy
Edit
composer install
npm install
3️⃣ Setup Environment File
Create a .env file by copying the example file:

sh
Copy
Edit
cp .env.example .env
Update database configurations in .env file:

env
Copy
Edit
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
4️⃣ Run Migrations & Seed Data
sh
Copy
Edit
php artisan migrate --seed
5️⃣ Start the Development Server
sh
Copy
Edit
php artisan serve
Visit http://127.0.0.1:8000 in your browser.

🌍 Project Links
GitHub Repository: Task Manager

Live Demo (if hosted): Not Hosted

📜 License
This project is open-source and available under the MIT License.
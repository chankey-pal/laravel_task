# Task Manager 📝🚀

Task Manager is a Laravel-based web application designed to help users manage tasks efficiently. It includes authentication, task management with CRUD operations, filtering, pagination, and an AJAX-powered infinite scroll.

## 📌 Features  

### ✅ Authentication System  
- Users can **register, log in, and log out** securely.  
- Middleware (`auth`) ensures only logged-in users can access tasks.  

### ✅ Task Management  
- **CRUD Operations**: Users can **create, edit, update, delete** tasks.  
- **Status Updates**: Tasks can be marked as **pending, in progress, or completed**.  
- **Validation**: Ensures valid inputs (e.g., due dates must be today or later).  

### ✅ Pagination & Filtering  
- **Tasks are paginated (4 per page)** for better UX.  
- Users can filter tasks by status (`pending, in progress, completed`).  

### ✅ AJAX & Infinite Scroll  
- Instead of traditional pagination, tasks load dynamically when scrolling.  
- AJAX requests fetch the next set of tasks without reloading the page.  


## 🛠️ Tech Stack  
- **Backend**: Laravel 9.52.20, MySQL  
- **Frontend**: Bootstrap 5, jQuery, AJAX, Quill.js  
- **Authentication**: Laravel's Auth Middleware  
- **Deployment**: GitHub (for version control), optional deployment on Laravel Forge/Vercel  

## 🌍 How to Access the Project?  
- **GitHub Repo:** [https://github.com/chankey-pal/laravel_task]  
- **Live Demo (if hosted):** [Not Hosted]  

---

### 📜 License  
This project is open-source and available under the MIT License.  

### Setup
Create database with name (laravel)
Then Run Migration Command
(If YOu Want Run It In local Host xamp Run Command php Artisan serve IN Terminal)
 Then Create .env file
 Then register and Login 
 It Will Run


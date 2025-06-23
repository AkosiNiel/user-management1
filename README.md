# User Management System (Pure PHP + Pure Css

This project is a pure PHP-based user management system using OOP principles It includes login/logout, role-based access (superadmin/user), user CRUD, profile editing, and session-based authentication.

---

## 🛠 Requirements
- PHP >= 7.4 (recommended: PHP 8.0+)
- XAMPP (Apache + MySQL)
- Composer (optional, not required for basic setup)

---

## 📦 Folder Structure
```
/your-folder
├── index.php
├── auth_guard.php
├── manage_accounts.php
├── edit_account.php
├── create_user.php
├── delete_user.php
├── toggle_status.php
├── /templates
├── /classes
├── /css (optional if you use local Bootstrap)
├── app.sql (database dump)
```

---

## 📝 Database Setup (Import `app.sql`)
> The `app.sql` file is included in the project folder.

1. Open **phpMyAdmin** via XAMPP
2. Create a new database, e.g. `myapp_db`
3. Click the **database name**, then click the **Import** tab
4. Choose the `app.sql` file from the project folder
5. Click **Go** to execute the import

> ⚠️ Ensure your MySQL port is set to `3308` (if default was changed)

---

## 🚀 Step-by-Step Setup in XAMPP

### 1. Copy the Files
- Place all source files in `C:/xampp/htdocs/your-folder-name`

### 2. Edit Database Connection
- Open `classes/Database.php`
```php
$this->pdo = new PDO('mysql:host=localhost;port=3308;dbname=myapp_db', 'root', '');
```
Adjust database name and port if needed.

### 3. Start Services
- Open XAMPP Control Panel
- Start **Apache** and **MySQL**

### 4. Access the App
Visit in browser:
```
http://localhost/your-folder-name/index.php
```
Or direct pages:
```
http://localhost/your-folder-name/manage_accounts.php
http://localhost/your-folder-name/edit_account.php
```

---

## 👤 Default Roles
- `superadmin` – full access, can manage users (username:admin, password:admin)
- `user` – can only edit own account

> Use phpMyAdmin to manually insert or update roles if needed

---

## 📌 Notes
- Logout will prevent access via browser back
- Use `auth_guard.php` in all protected pages
- DataTables, Bootstrap 5, and basic form validation are included

---

## 🧪 Testing
- Test login/logout
- Create/edit/delete users
- Switch account status via toggle
- Try accessing protected pages when logged out

---



For issues or contributions, contact the lead developer.

---

Enjoy! 🚀

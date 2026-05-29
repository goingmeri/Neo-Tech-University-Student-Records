# Student CRUD — NCT Neo Theme
> A PHP + MySQL student records app with an edgy black & lime green UI inspired by NCT.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-XAMPP-CA2136?style=flat-square&logo=apache&logoColor=white)

---

## Features
- **Create** — Add new student records
- **Read** — View all students in a styled table
- **Update** — Edit existing student info
- **Delete** — Remove students with confirmation prompt
- **NCT Neo UI** — Dark theme with lime green (#AAFF00) accents, Barlow Condensed typography, and scanline texture
- **Secure** — All queries use prepared statements to prevent SQL injection

---

## Requirements
- Apache (XAMPP recommended for Windows)
- PHP 7.4+
- MySQL / MariaDB

---

## Setup

1. **Copy** the `student-crud/` folder into your Apache web root:
   - XAMPP (Windows): `C:\xampp\htdocs\student-crud`
   - MAMP (macOS): `/Applications/MAMP/htdocs/student-crud`
   - LAMP (Linux): `/var/www/html/student-crud`

2. **Start** Apache and MySQL in XAMPP Control Panel.

3. **Import the database:**
   - Open `http://localhost/phpmyadmin`
   - Click **Import** → choose `db.sql` → click **Go**

4. **Check credentials** in `config.php` (default is `root` with no password — standard XAMPP setup):
   ```php
   $host = 'localhost';
   $user = 'root';
   $pass = '';
   $db   = 'student_db';
   ```

5. **Visit:** `http://localhost/student-crud/`

---

## File Structure

```
student-crud/
├── config.php   — Database connection
├── index.php    — List all students
├── create.php   — Add a student
├── edit.php     — Update a student
├── delete.php   — Delete a student
├── style.css    — NCT Neo dark theme
└── db.sql       — Database schema
```

---

## Theme
Built with the **NCT** aesthetic in mind — pitch black background, sharp lime green (`#AAFF00`) as the hero color, condensed uppercase typography via [Barlow Condensed](https://fonts.google.com/specimen/Barlow+Condensed), and a subtle scanline overlay for that neo/futuristic feel.

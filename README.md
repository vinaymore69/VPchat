# VPchat

**VPchat** is a PHP-based chatbot application that interacts with a self-hosted MySQL database. It features two main user interfaces — **Admin** and **Student** — and provides dynamic responses by retrieving relevant data from the database. The system also tracks user login and logout activities for improved session management and analytics.

## 🔧 Tech Stack

- **Backend**: PHP  
- **Database**: MySQL  
- **Frontend Styling**: Tailwind CSS  
- **Interfaces**: Admin & Student

## 📌 Features

- 🔹 **Chatbot Functionality**: Retrieves information from a self-managed MySQL database.
- 🔹 **Admin Interface**: Manage chatbot responses, users, and system data.
- 🔹 **Student Interface**: User-friendly chatbot interaction and session tracking.
- 🔹 **User Session Logging**: Tracks and stores login/logout activity in the database.
- 🔹 **Tailwind CSS Styling**: Clean, responsive design using utility-first CSS.

## 📂 Folder Structure (Simplified)

```
VPchat/
│
├── admin/             # Admin panel
├── student/           # Student interface
├── css/               # Tailwind CSS files
├── db/                # Database connection scripts
├── includes/          # Common components (e.g., header, footer)
├── chatbot.php        # Core chatbot logic
└── README.md
```

## 🛠️ Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone https://github.com/vinaymore69/VPchat.git
   ```

2. **Set up your MySQL database:**
   - Import the SQL dump (if provided) or create the tables manually.
   - Update your database connection details in `/db/connection.php`.

3. **Run the application:**
   - Use XAMPP, WAMP, or a similar local server.
   - Access the project in your browser (e.g., `http://localhost/VPchat/`).

## 📸 Screenshots

*(You can add screenshots here showing the Admin panel, Student chat interface, and database structure if needed.)*

## 📌 Notes

- Ensure Tailwind CSS is properly included if using custom builds.
- You may enhance chatbot intelligence by expanding the database and logic in `chatbot.php`.

## 👨‍💻 Author

**Vinay More**  
GitHub: [vinaymore69](https://github.com/vinaymore69)
GitHub: [shreyapanhale0568](https://github/shreyapanhale0568)

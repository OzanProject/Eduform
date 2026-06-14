# EduForm - Modern Form Builder Assessment

![EduForm Cover](https://via.placeholder.com/1200x400/3b82f6/ffffff?text=EduForm+Assessment)

EduForm is a modern, responsive, and intuitive Form Builder application developed specifically for the **Ozan Project** assessment. It provides an app-like experience for both the form creators (administrators) and the respondents.

---

## 🚀 Features
- **App-like Landing Page**: Modern UI with glassmorphism, responsive components, and dynamic branding.
- **Dynamic Branding**: The Application name, subtitle, and logo can be managed dynamically through the settings panel.
- **Advanced Form Builder**: Drag-and-drop-like feeling, allowing creators to build various question types:
  - Short Text
  - Paragraph
  - Radio Button
  - Checkboxes
  - Dropdown
  - Date
  - Time
  - File Upload (Docs / Images)
- **Live Form Responses**: Real-time view of collected data with search, pagination, and data export options.
- **Responsive Design**: Built purely with Tailwind CSS, ensuring 100% responsiveness on Mobile, Tablet, and Desktop screens.
- **Anti-Spam Mechanism**: Built-in "I'm not a robot" instantaneous verification UI using AlpineJS and secure Livewire backend validation to prevent bot spam.

---

## 📋 PRD (Product Requirements Document)

### 1. Objective
To build a scalable, maintainable, and highly responsive Form Builder web application that enables users to create customizable forms, gather responses, and manage data efficiently.

### 2. Target Audience
- **Administrators**: Users who create, publish, and manage forms and analyze the submitted responses.
- **Respondents**: End-users who access the public form link to submit answers or upload files.

### 3. Key Requirements
- **Authentication**: Secure Login/Registration for form creators.
- **Dashboard**: A central hub to manage created forms.
- **Form Editor**: Must support setting titles, descriptions, banner headers, and multiple question types with validation (required/optional).
- **Public Form Link**: A unique, shareable URL for each form.
- **Data Collection**: Secure storing of form responses and file uploads up to 5MB.
- **Security**: Must implement bot protection before form submission.
- **Settings**: Global configuration to customize the application’s branding (name, logo, etc.).

### 4. Tech Stack
- **Framework**: Laravel 11.x
- **Frontend/Reactivity**: Livewire 3 + Alpine.js
- **Styling**: Tailwind CSS 3
- **Database**: MySQL / SQLite

---

## 🗄️ ERD (Entity Relationship Diagram)

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        timestamp email_verified_at
        string password
    }

    FORMS {
        bigint id PK
        bigint user_id FK
        string title
        string slug
        text description
        string header_image
        boolean is_active
        string confirmation_message
        timestamp created_at
    }

    QUESTIONS {
        bigint id PK
        bigint form_id FK
        string type "short_text, paragraph, radio, etc."
        string text
        text description
        boolean is_required
        integer order
    }

    QUESTION_OPTIONS {
        bigint id PK
        bigint question_id FK
        string value
        integer order
    }

    RESPONSES {
        bigint id PK
        bigint form_id FK
        string session_id
        timestamp created_at
    }

    ANSWERS {
        bigint id PK
        bigint response_id FK
        bigint question_id FK
        text value
    }

    SETTINGS {
        bigint id PK
        string key
        text value
    }

    USERS ||--o{ FORMS : "creates"
    FORMS ||--o{ QUESTIONS : "contains"
    FORMS ||--o{ RESPONSES : "receives"
    QUESTIONS ||--o{ QUESTION_OPTIONS : "has"
    QUESTIONS ||--o{ ANSWERS : "answered_by"
    RESPONSES ||--o{ ANSWERS : "contains"
```

---

## 🛠️ Installation & Setup

If you want to run this project locally, follow these steps:

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or SQLite

### 1. Clone the Repository
```bash
git clone https://github.com/OzanProject/Eduform.git
cd Eduform
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy the `.env.example` file and configure your database variables:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run Migrations & Seeder (Optional)
```bash
php artisan migrate --seed
```

### 5. Link Storage (Crucial for File Uploads and Logos)
```bash
php artisan storage:link
```

### 6. Build Frontend Assets
*(Note: Production build files are already included in this repository under `/public/build`, but you can rebuild them if you make changes)*
```bash
npm run build
```

### 7. Run the Application
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.

---

## 👨‍💻 Development

Developed by **Ozan Project** as an assessment project. Focuses heavily on best practices, UI/UX, and performance optimization.

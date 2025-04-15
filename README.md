# 🏠 Room Rental Portal

## 📖 Project Overview

The Room Rental Portal is a full-featured web platform designed to connect students searching for rental rooms with owners listing available spaces. The platform includes various functionalities for students, owners, and administrators to manage their interactions seamlessly.

## 🛠 Tech Stack

- **Backend**: Laravel / Node.js (customizable)
- **Frontend**: React / Blade / Bootstrap / Tailwind
- **Database**: MySQL
- **Authentication**: OTP-based + Email-password
- **Payment Gateway**: Razorpay / Stripe (modular)
- **Image Handling**: File Uploads & Cloud Storage
- **Other**: REST APIs, Role-Based Access Control, CMS

## 🌟 Features

- Room listing & filtering (location, price, capacity, etc.)
- Owner dashboard with room & booking management
- Booking + payment flow with invoice & status
- Complaint registration & resolution system
- Admin dashboards with analytics & approval features
- CMS for FAQs, Testimonials, Static Pages
- OTP-based password reset & secure login
- Multi-role login system: student, owner, admin

## 👥 Modules & Roles

### 👨‍🎓 Student / User

- Browse & filter rooms (without login)
- View room details, amenities, prices, photos
- Register/login with OTP/email
- Book rooms, pay online, view booking history
- Rate & review rooms
- File complaints
- Manage profile, documents, ID cards

### 🧑‍💼 Owner

- Add / edit rooms with detailed info and photos
- See bookings, accept/reject them
- Manage availability, room visibility
- View complaints related to rooms
- View payment settlements
- Edit own profile, banking info

### 👨‍💻 Admin

- Dashboard with total users, rooms, complaints
- Manage room approvals, user verification
- Block / delete fake accounts
- View payments, generate reports
- CMS for FAQs, Testimonials, Static Pages
- Handle complaints and assign resolutions

## 🧩 Database Models

### 🧍 User

- `username`, `email`, `password`, `phone`
- `role`: user / owner
- Provider fields for social login

### 📄 Profile (User  & Owner)

- `DOB`, `gender`, `address`, `documents`, `bank details`

### 🏠 Room

- `title`, `description`, `capacity`, `amenities`, `prices`
- Images (room, kitchen, house)
- Restrictions, floor, bathroom/kitchen types

### 📦 Booking

- `room_id`, `user_id`, `dates`, `payment info`
- `status`: pending / accepted / cancelled

### ⭐ Review

- `user_id`, `booking_id`, `rating`, `text`

### ⚠ Complaint

- `user_id`, `room_id`, `description`, `status`

### 💳 Payment

- `booking_id`, `amount`, `mode`, `date`

### 🧾 Contact Message

- `name`, `email`, `subject`, `message`, `status`

## 🗂 Pages Overview

### 🔓 Public (No login)

- Landing Page
- About Us
- FAQ
- Contact Us
- Login / Register / Forgot Password (OTP)

### 👨‍🎓 Student Side

- Home Page (room listings)
- Room Detail Page
- Profile Page
- Booking History + Payments
- Review Submission
- Complaint Form + History

### 🧑‍💼 Owner Side

- Dashboard (summary cards)
- Room Management
- Add Room
- View/Edit Room
- Bookings
- Complaints
- Profile + Bank Details

### 👨‍💻 Admin Side

- Dashboard:
  - Total Users, Rooms, Complaints
  - Booking & Revenue Graphs
- Room Approval Page
- Bookings
- Complaints Management
- Payments (settlement to owners)
- Users Management (block/unblock/delete)
- CMS (FAQs, Testimonials, Static Pages)
- Reports

## 🔐 Authentication & Security

- OTP based password reset
- Social login support (Google/Facebook)
- Role-based access control
- Email/phone uniqueness checks
- Secure image uploads

## 📋 CMS Panels

### FAQs Panel

- Create, update, delete FAQ entries

### Testimonials Panel

- Manage student reviews/testimonials

### Static Pages

- About Us, Contact Us with WYSIWYG editor

## 🛎️ Support & Contact

- Dedicated contact form (viewable in admin)
- Complaint submission + response system
- Ticket status tracking

## 💻 Run Locally

To run the project locally, follow these steps:

```bash
git clone https://github.com/your-repo/room-rental.git
cd room-rental
composer install / npm install
php artisan migrate --seed
php artisan serve
```

## 🤝 Contributing
Contributions are welcome! If you have suggestions for improvements or new features, please open an issue or submit a pull request.

## 📞 Contact
For any inquiries or support, please reach out via the contact form on the platform or directly through the repository.
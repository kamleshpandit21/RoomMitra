# 🏠 RoomMitra (A Room Rental Portal) 

![Room Rental Logo](public/logo/RoomLogo.png)

## 📖 Overview

Room Rental Portal is a full-featured web platform built to connect students with room owners. It offers seamless room browsing, booking, and payment experiences for students, while empowering owners and admins with powerful tools for management and oversight.

## 🛠 Tech Stack

* **Backend**: Laravel 
* **Frontend**: Blade / Bootstrap
* **Database**: MySQL
* **Authentication**: Email + OTP
* **Payments**: Razorpay (UPI/Card/Wallet)
* **File Handling**: Cloud Storage & Uploads
* **Architecture**: REST APIs, Modular MVC

## 🌟 Key Features

* 🔎 Room listing, advanced filtering (location, price, amenities)
* 💬 Owner dashboard with room and booking management
* 💳 Online booking with integrated payment gateway
* 📄 Auto-generated invoices, booking summaries
* ⚠️ Complaint & resolution system
* 📊 Admin dashboard with analytics & user controls
* 📃 CMS for FAQs, Testimonials, Static Pages

## 👥 User Roles

### 👨‍🎓 Students

* Browse rooms (without login)
* Filter by amenities, price, distance
* Book & pay online
* View booking/invoice history
* Submit reviews and complaints

### 🧑‍💼 Owners

* Add/edit rooms with photos and details
* View & manage bookings
* Handle availability
* Respond to complaints

### 👨‍💻 Admins

* Approve rooms and verify users
* View complaints and payment logs
* Manage users & CMS content
* Generate reports & analytics

## 🧩 Core Data Models

* **User**: role, contact, password, login method
* **Profile**: DOB, documents, address, banking info
* **Room**: title, price, amenities, images, capacity
* **Booking**: user, room, dates, payment info, status
* **Payment**: mode, booking\_id, amount
* **Complaint**: user, room, description, status
* **Review**: user, rating, text, room\_id
* **Message**: contact form fields

## 🖼 Public Pages

* Landing
* About Us
* FAQs
* Contact Us
* Login / Register / OTP Recovery

## 📋 CMS

* Manage FAQs
* Handle testimonials
* Edit About/Terms pages

## 🔐 Security

* OTP + password login options
* Role-based access restrictions
* Secure image uploads


## 💳 Payment Integration (in next update)

* **Razorpay Checkout**: Secure, supports UPI, card, wallet
* Auto-calculate rent, security deposit, and optional services

## ▶️ Local Setup

```bash
git clone https://github.com/your-repo/room-rental.git
cd room-rental
composer install
npm install
php artisan migrate --seed
php artisan serve
```

## 🤝 Contribution

We welcome pull requests! Please fork the repo and raise an issue or PR for improvements.

## 📞 Contact

Submit queries via the Contact Us form on the website or reach us via GitHub Issues.

---



> Built with ❤️ for students and property owners

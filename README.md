# Event Booking System

## Përshkrimi
Ky projekt është një aplikacion web i zhvilluar në PHP për menaxhimin dhe rezervimin e eventeve. Sistemi lejon përdoruesit të shohin evente, të bëjnë rezervime dhe të përdorin funksione të ndryshme si autentikimi, kontrolli i roleve dhe menaxhimi i të dhënave përmes databazës.

## Funksionalitetet
Faza I
Shfaqja e eventeve
Faqja e detajeve të eventit
Sistemi i rezervimit (Booking)
Login / Logout
Role: Admin dhe User
Kontroll i aksesit sipas roleve
Përdorimi i OOP (Event dhe PremiumEvent)
Sortimi i eventeve
Contact form me validim
Validim me RegEx
Përdorimi i cookies
Menaxhimi i sesioneve

Faza II
Integrimi i databazës me PHP PDO
CRUD për evente (Create, Read, Update, Delete)
Upload i fotografive të eventeve
Sistemi i rezervimeve me databazë
AJAX për veprime dinamike
Try/Catch për trajtimin e gabimeve
Login/Register me databazë
Funksione sigurie
Integrimi i API (Weather API)
Dërgimi i email-eve
Error handling

## Struktura e projektit
Event-Booking-System
│
├── api
│   └── weather.php
│
├── assets
│   ├── css
│   │   └── style.css
│   │
│   ├── images
│   │   ├── art.jpg
│   │   ├── charity.jpg
│   │   ├── fashion.jpg
│   │   ├── food.jpg
│   │   ├── gaming.jpg
│   │   ├── music.jpg
│   │   ├── photography.jpg
│   │   ├── startup.jpg
│   │   └── tech.jpg
│   │
│   └── js
│       └── event.js
│
├── classes
│   ├── Event.php
│   └── PremiumEvent.php
│
├── data
│   └── all_events.php
│
├── includes
│   ├── auth.php
│   ├── cookies.php
│   ├── database.php
│   ├── email_functions.php
│   ├── error_handler.php
│   ├── footer.php
│   ├── header.php
│   ├── nav.php
│   ├── users.php
│   └── validation.php
│
├── pages
│   ├── events
│   │   ├── ajax_delete.php
│   │   ├── create.php
│   │   ├── delete.php
│   │   ├── edit.php
│   │   └── index.php
│   │
│   ├── about.php
│   ├── admin.php
│   ├── booking.php
│   ├── confirm.php
│   ├── contact.php
│   ├── dashboard.php
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   └── view_event.php
│
├── uploads
│   └── events
│       ├── 1779566191_tech.jpg
│       ├── 1779566716_music.jpg
│       ├── 1779567074_food.jpg
│       └── 1779650110_art.jpg
│
├── .gitignore
├── README.md
└── index.php

## Databaza
Emri i databazës: eventbooking
Tabelat:
users
events
bookings
Porti i MySQL: 3307

## Ekzekutimi i Projektit
Vendos projektin në:
C:\xampp\htdocs\project
Starto:
Apache
MySQL
Importo databazën:
eventbooking.sql
Hap projektin në browser:
http://localhost:8080/project/

 ## Anëtarët e projektit
  • Eliona Muja
  • Festa Berisha
  • Fiona Grabovci
  • Jeta Podrimcaku

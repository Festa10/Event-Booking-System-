# Event Booking System - Base Application

## Përshkrimi
Kjo pjesë përfshin bazën e aplikacionit për projektin Event Booking System.  
Është ndërtuar struktura kryesore e website-it, përfshirë faqen kryesore (Home), faqen e rezervimit (Booking), si dhe faqet shtesë si About, Contact dhe Event Details.  
Gjithashtu është implementuar një klasë për menaxhimin e eventeve.

---

## Struktura
includes/
- header.php (pjesa e sipërme e faqes)
- nav.php (navbar për navigim)
- footer.php (pjesa e poshtme)

pages/
- booking.php (faqja për rezervim)
- events.php (lista e eventeve)
- event-details.php (detajet e eventit)
- about.php (informacion rreth projektit)
- contact.php (faqja e kontaktit)

classes/
- Event.php (klasa për përfaqësimin dhe menaxhimin e eventeve)

root/
- index.php (Home page)

assets/
- css/
- images/

---

## Funksionalitetet
- Home Page me listë eventesh
- Shfaqje e eventeve me foto dhe përshkrim
- Faqe për detajet e eventit (Event Details)
- Navigim përmes navbar:
  - Home
  - Events
  - Booking
  - About
  - Contact
  - Login / Register
- Booking form:
  - Full Name
  - Email
  - Event (sipas zgjedhjes)
- Faqe informative:
  - About
  - Contact
- Përdorimi i klasës `Event` për organizimin e të dhënave

---

## Karakteristikat
- Strukturë e organizuar (includes, pages, classes, assets)
- Përdorim i PHP include për layout të përbashkët
- Kod i ndarë në mënyrë modulare
- Dizajn modern dhe i pastër
- Gati për integrim me autentikim dhe databazë

---

## Ekzekutimi
1. Vendos projektin në:
   C:\xampp\htdocs\project

2. Starto Apache në XAMPP

3. Hap në browser:
   http://localhost/project/

---

# Event Booking System - Auth Module

## Përshkrimi
Kjo pjesë përfshin sistemin e login/logout për projektin Event Booking System, pa përdorur databazë.  
Përdoren përdorues të definuar në kod (hardcoded), session dhe role (admin/user).

## Struktura
includes/
- auth.php (logjika e login dhe session)
- users.php (përdoruesit)

pages/
- login.php
- logout.php
- dashboard.php
- admin.php

## Funksionalitetet
- Login / Logout
- Session për ruajtjen e përdoruesit
- Role: admin dhe user
- Kontroll i aksesit sipas rolit

## Kredencialet
Admin:
- username: admin
- password: admin123

User:
- username: user
- password: user123

## Ekzekutimi
1. Vendos projektin në htdocs
2. Starto Apache në XAMPP
3. Hap:
http://localhost/event-booking-system/pages/login.php 

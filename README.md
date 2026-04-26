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
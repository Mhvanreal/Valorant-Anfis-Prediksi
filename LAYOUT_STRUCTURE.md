# Layout Structure Documentation

## Overview

Dashboard menggunakan struktur layout yang terpisah dan modular dengan komponen sidebar dan navigation yang independen.

## File Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Main layout wrapper
│   ├── navigation.blade.php    # Top navbar (desktop & mobile)
│   └── sidebar.blade.php       # Left sidebar (desktop only)
└── dashboard.blade.php         # Dashboard content
```

## Component Details

### 1. app.blade.php (Main Layout)

**Lokasi**: `resources/views/layouts/app.blade.php`

**Fungsi**:

-   Layout utama yang membungkus seluruh halaman dashboard
-   Include navigation dan sidebar
-   Mengatur struktur flex untuk sidebar + content area

**Struktur**:

```blade
<body>
    <navigation />  <!-- Top navbar -->
    <div class="flex">
        <sidebar />  <!-- Left sidebar -->
        <main>
            {{ $slot }}  <!-- Content area -->
        </main>
    </div>
</body>
```

---

### 2. navigation.blade.php (Top Navbar)

**Lokasi**: `resources/views/layouts/navigation.blade.php`

**Fitur**:

-   ✅ Fixed position di atas (z-50)
-   ✅ Logo dengan icon biru
-   ✅ Tombol notifikasi (desktop)
-   ✅ User dropdown dengan avatar (desktop)
-   ✅ Hamburger menu (mobile)
-   ✅ Mobile menu dengan semua navigasi

**Responsive**:

-   **Desktop**: Logo + Notifications + User Dropdown
-   **Mobile**: Logo + Hamburger → Full menu saat dibuka

---

### 3. sidebar.blade.php (Left Sidebar)

**Lokasi**: `resources/views/layouts/sidebar.blade.php`

**Fitur**:

-   ✅ Search box untuk filter menu
-   ✅ Collapsible menu (Data Management, Reports)
-   ✅ Badge notifikasi (contoh: Predictions "3")
-   ✅ Submenu dengan indentasi
-   ✅ Active state highlighting
-   ✅ User info di footer sidebar
-   ✅ Scroll otomatis untuk konten panjang

**Menu Sections**:

1. **Main Menu**

    - Dashboard (active state)
    - Predictions (dengan badge)
    - Analytics

2. **Management** (collapsible)

    - Data Management (parent)
        - Weapons (submenu)
        - Skins (submenu)
        - Categories (submenu)
    - Users

3. **Reports** (collapsible)

    - Report Center (parent)
        - Prediction Reports (submenu)
        - Financial Reports (submenu)
        - Analytics Reports (submenu)

4. **Settings**
    - Profile
    - Settings

**Alpine.js State**:

```javascript
{
    managementOpen: false,    // Toggle Data Management menu
    reportsOpen: false,       // Toggle Reports menu
    searchQuery: ''           // Filter menu items
}
```

**Responsive**:

-   **Desktop**: Visible (width: 256px)
-   **Mobile**: Hidden (menu ada di navigation mobile)

---

### 4. dashboard.blade.php (Content)

**Lokasi**: `resources/views/dashboard.blade.php`

**Struktur**:

```blade
<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <!-- Welcome Card -->
    <!-- Stats Grid (4 cards) -->
    <!-- Recent Activity & Quick Actions -->
</x-app-layout>
```

---

## Styling Theme

**Color Palette**:

-   Primary: Blue (blue-600, blue-700)
-   Secondary: Purple, Indigo, Green
-   Background: White, Gray-50
-   Text: Gray-800, Gray-700, Gray-500

**Components**:

-   Border radius: rounded-lg, rounded-xl
-   Shadows: shadow-sm, shadow-md
-   Transitions: duration-200, duration-300
-   Hover effects: bg-gray-100, bg-blue-50

---

## How to Use

### Extend di halaman lain:

```blade
<x-app-layout>
    <x-slot name="header">
        <h2>Page Title</h2>
    </x-slot>

    <!-- Your content here -->
</x-app-layout>
```

### Tambah menu baru di sidebar:

Edit `resources/views/layouts/sidebar.blade.php`:

```blade
<!-- Simple link -->
<a href="/your-route" class="flex items-center px-4 py-2.5 text-gray-700 rounded-lg hover:bg-gray-100">
    <svg class="w-5 h-5 mr-3"><!-- icon --></svg>
    <span>Menu Name</span>
</a>

<!-- Link with badge -->
<a href="#" class="flex items-center justify-between ...">
    <div class="flex items-center">
        <svg><!-- icon --></svg>
        <span>Menu Name</span>
    </div>
    <span class="px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">5</span>
</a>

<!-- Collapsible menu -->
<div>
    <button @click="menuOpen = !menuOpen">
        <div class="flex items-center">
            <svg><!-- icon --></svg>
            <span>Parent Menu</span>
        </div>
        <svg :class="{ 'rotate-180': menuOpen }"><!-- chevron --></svg>
    </button>

    <div x-show="menuOpen" x-collapse class="ml-4 mt-1 space-y-1">
        <!-- Submenu items -->
    </div>
</div>
```

### Active State:

Gunakan helper Laravel `request()->routeIs()`:

```blade
class="{{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}"
```

---

## Dependencies

-   **TailwindCSS**: Untuk styling
-   **Alpine.js**: Untuk interaktivitas (dropdown, collapse)
-   **Laravel Breeze**: Base authentication UI
-   **Inter Font**: Typography

---

## Catatan

1. **Alpine.js x-collapse** membutuhkan plugin Alpine Collapse:

    - Pastikan sudah terinstall di `resources/js/app.js`
    - Jika belum: `npm install @alpinejs/collapse`

2. **Responsive Design**:

    - Mobile: Content menggunakan full width
    - Desktop (md+): Content offset 256px (ml-64) untuk sidebar

3. **Fixed Positioning**:

    - Navbar: `top-0` dengan `h-16`
    - Sidebar: `top-16` dengan `h-[calc(100vh-4rem)]`
    - Main content: Padding untuk navbar + sidebar

4. **Customization**:
    - Warna: Ubah di Tailwind classes
    - Icons: Gunakan Heroicons atau custom SVG
    - Layout: Modifikasi `app.blade.php` untuk struktur berbeda

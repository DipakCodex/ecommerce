<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DipakHub • Your Online Marketplace</title>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite with Tailwind CSS 4.0 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom styles with root variables -->
    <style>
        /* ----- ROOT VARIABLES for DipakHub ----- */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary: #7c3aed;
            --accent: #f59e0b;
            --accent-soft: #fef3c7;
            --success: #10b981;
            --danger: #ef4444;
            --bg-light: #f8fafc;
            --bg-warm: #f1f5f9;
            --text-dark: #0f172a;
            --text-soft: #475569;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --border-muted: #cbd5e1;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
        }

        /* ----- Container with 86% width ----- */
        .container {
            width: 86%;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 1280px) {
            .container {
                max-width: 1320px;
            }
        }

        /* ----- Custom scrollbar ----- */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-warm);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* ----- Smooth animations ----- */
        * {
            transition: all 0.15s ease;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* ----- Custom form styles for Dokan registration ----- */
        .dokan-input {
            background-color: var(--white);
            border: 1.5px solid var(--border-light);
            border-radius: var(--radius-lg);
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .dokan-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .dokan-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.375rem;
            display: block;
            font-size: 0.9rem;
        }

        /* ----- Product card hover effects ----- */
        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }
    </style>
</head>

<body class="antialiased">
    <x-frontend-header>

    </x-frontend-header>
    <!-- ===== HERO BANNER ===== -->
   <main>
    {{$slot}}
   </main>
<x-frontend-footer>

</x-frontend-footer>

</body>

</html>

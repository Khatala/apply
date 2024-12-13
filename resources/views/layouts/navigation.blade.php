<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lesotho Hub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Internal CSS for styling -->
        <style>
            /* General Body styling */
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f4f4f9; /* Light background */
                color: #333; /* Dark text */
                margin: 0;
                padding: 0;
            }

            /* Styling for header */
            header {
                color: white; /* White text */
                padding: 20px 0; /* Padding for top and bottom */
            }

            header .max-w-7xl {
                max-width: 100%; /* Full width */
                margin: 0 auto; /* Center content */
                padding: 0 20px; /* Horizontal padding */
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            header h2 {
                font-size: 1.75rem; /* Font size for the header title */
                font-weight: 600; /* Font weight */
                text-transform: uppercase; /* Uppercase text */
                letter-spacing: 1px; /* Slight letter spacing */
            }

            .welcome-message {
                font-size: 1.125rem;
                font-weight: 400;
                color: #ffffff;
            }


            /* Main content area styling */
            main {
                padding: 20px;
                background-color: #fff;
                margin-top: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Styling for the navigation menu */
            .nav-menu {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .nav-menu a {
                text-decoration: none;
                color: #6366f1;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: 4px;
                transition: background-color 0.3s ease;
            }

            .nav-menu a:hover {
                background-color: #6366f1;
                color: white;
            }

            /* Navbar styling */
            nav {
                background: linear-gradient(to right, #4f46e5, #6366f1);
                padding: 0.5rem 2rem;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* Brand Logo and Navbar Links */
            .nav-links {
                display: flex;
                align-items: center;
            }

            .nav-links a {
                color: white;
                font-size: 1rem;
                font-weight: 500;
                margin-right: 1rem;
                transition: color 0.3s ease;
            }

            .nav-links a:hover {
                color: #fbbf24;
            }

            /* Responsive Hamburger Menu */
            .hamburger-menu {
                display: none;
                cursor: pointer;
            }

            .hamburger-menu svg {
                width: 30px;
                height: 30px;
                fill: white;
            }

            @media (max-width: 768px) {
                .nav-links {
                    display: none;
                    flex-direction: column;
                    margin-top: 1rem;
                    width: 100%;
                    background-color: #6366f1;
                    padding: 1rem;
                    border-radius: 8px;
                }

                .nav-links.open {
                    display: flex;
                }

                .hamburger-menu {
                    display: block;
                }

                .nav-links a {
                    padding: 10px;
                    text-align: center;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Navigation menu -->
            <nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-700 via-blue-600 to-indigo-500 shadow-lg">
                <!-- Container -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Left Section -->
                        <div class="flex items-center space-x-8">
                            <!-- Brand Logo -->
                            <a href="{{ route('dashboard') }}" class="flex items-center text-white font-extrabold text-2xl hover:scale-105 transform transition-all duration-300">
                                <svg class="h-8 w-8 mr-2 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v6m0 0L8.5 6.5m3.5 2.5L15.5 6.5m-3.5 9V9m0 6l3.5 3.5m-3.5-3.5L8.5 15.5" />
                                </svg>
                                Lesotho Hub
                            </a>

                            <!-- Navigation Links -->
                            <div class="hidden md:flex items-center space-x-6">
                                <a href="{{ route('dashboard') }}" class="text-lg text-white font-medium hover:text-yellow-400 hover:underline underline-offset-4">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="hidden sm:flex items-center space-x-4">
                            <span class="text-sm text-white font-semibold bg-yellow-400 px-3 py-1 rounded-full">
                                Welcome, {{ Auth::user()->name }}
                            </span>

                            <!-- Profile Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-white text-sm font-medium hover:text-yellow-300 transition">
                                        <div>{{ Auth::user()->name }}</div>
                                        <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-600">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-red-500">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Hamburger Menu -->
                        <div class="flex items-center sm:hidden">
                            <button @click="open = !open" class="text-white hover:text-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div x-show="open" @click.away="open = false" class="md:hidden">
                    <div class="space-y-4 p-4">
                        <a href="{{ route('dashboard') }}" class="block text-white text-lg font-medium hover:bg-indigo-500 p-2 rounded">Dashboard</a>
                    </div>
                </div>
            </nav>

            <!-- Profile Edit Form -->
            <main>
                <div>
                    <h2 class="text-3xl text-center mb-4">Edit Your Profile</h2>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <!-- Add form fields here -->
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>

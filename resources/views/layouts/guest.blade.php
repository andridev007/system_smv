<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                body {
                    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                    background-color: #0a0a0a;
                    color: #EDEDEC;
                    min-height: 100vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 1rem;
                }
                .container {
                    width: 100%;
                    max-width: 400px;
                    background-color: #161615;
                    border-radius: 0.5rem;
                    padding: 2rem;
                    box-shadow: inset 0px 0px 0px 1px rgba(255, 250, 237, 0.18);
                }
                h1 {
                    font-size: 1.5rem;
                    font-weight: 600;
                    margin-bottom: 1.5rem;
                    text-align: center;
                    color: #EDEDEC;
                }
                .form-group {
                    margin-bottom: 1rem;
                }
                label {
                    display: block;
                    font-size: 0.875rem;
                    font-weight: 500;
                    color: #A1A09A;
                    margin-bottom: 0.5rem;
                }
                input[type="text"],
                input[type="email"],
                input[type="password"],
                input[type="tel"] {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    background-color: #1b1b18;
                    border: 1px solid #3E3E3A;
                    border-radius: 0.375rem;
                    color: #EDEDEC;
                    font-size: 0.875rem;
                    outline: none;
                    transition: border-color 0.15s ease;
                }
                input[type="text"]:focus,
                input[type="email"]:focus,
                input[type="password"]:focus,
                input[type="tel"]:focus {
                    border-color: #62605b;
                }
                input::placeholder {
                    color: #706f6c;
                }
                .checkbox-group {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    margin-bottom: 1rem;
                }
                input[type="checkbox"] {
                    width: 1rem;
                    height: 1rem;
                    accent-color: #f53003;
                }
                .checkbox-group label {
                    margin-bottom: 0;
                    font-size: 0.875rem;
                    color: #A1A09A;
                }
                .btn {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    background-color: #eeeeec;
                    border: 1px solid #eeeeec;
                    border-radius: 0.375rem;
                    color: #1C1C1A;
                    font-size: 0.875rem;
                    font-weight: 500;
                    cursor: pointer;
                    transition: background-color 0.15s ease;
                    text-decoration: none;
                    display: inline-block;
                    text-align: center;
                }
                .btn:hover {
                    background-color: #ffffff;
                    border-color: #ffffff;
                }
                .link {
                    color: #FF4433;
                    text-decoration: none;
                    font-size: 0.875rem;
                }
                .link:hover {
                    text-decoration: underline;
                }
                .text-center {
                    text-align: center;
                }
                .mt-4 {
                    margin-top: 1rem;
                }
                .error-message {
                    color: #FF4433;
                    font-size: 0.75rem;
                    margin-top: 0.25rem;
                }
                .flex-between {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
            </style>
        @endif
    </head>
    <body>
        <div class="container">
            {{ $slot }}
        </div>
    </body>
</html>

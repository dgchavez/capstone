<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
           <!-- fav.ico -->
        <link rel="icon" href="{{ asset('assets/2.png') }}" type="image/png"> <!-- If using an ICO file -->
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
                <!-- ========== HEADER ========== -->
                <livewire:top-bar-navigation />
                <!-- ========== END HEADER ========== -->
                <!-- ========== HERO ========== -->
                <div class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <livewire:landing-page-body />  
                     
                    </div>
                </div>
                <div class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                            <livewire:team-section /> 
                    </div>
                </div>
                <div class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                            <livewire:feature-section /> 
                    </div>
                </div>
                <div class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                            <livewire:gallery-section /> 
                    </div>
                </div>
      
      
      
                <!-- ========== END HERO ========== -->
    </body>
    </body>
    <br>
    <br>
    <br>    
    <footer>
                    <livewire:footer-section /> 
  
    </footer>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My School</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-50 font-sans antialiased">
        <div class="">
            <div class="container mx-auto p-8">
                <h1 
                    class="text-3xl text-slate-800 font-semibold"
                >Wonde Testing School</h1>

                <h2 class="text-2xl font-medium text-gray-800">Teachers Directory</h2>

                <table class="border-collapse w-full border border-slate-400 mt-8">
                    <thead class="bg-slate-100">
                      <tr>
                        <th class="border border-slate-300 p-2">Title</th>
                        <th class="border border-slate-300 p-2">Name</th>
                        <th class="border border-slate-300 p-2">Email</th>
                        <th class="border border-slate-300 p-2">Start date</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td 
                                    class="border border-slate-300 p-2"
                                >{{ Arr::get($teacher, 'title') }}</td>

                                <td 
                                    class="border border-slate-300 p-2"
                                >{{ Arr::get($teacher, 'name') }}</td>

                                <td 
                                    class="border border-slate-300 p-2"
                                >{{ Arr::get($teacher, 'email') }}</td>

                                <td 
                                    class="border border-slate-300 p-2"
                                >{{ Arr::get($teacher, 'startDate') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </body>
</html>

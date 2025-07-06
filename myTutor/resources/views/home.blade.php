<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>Bienvenidos! </h1>
    <div
        class="mx-auto flex max-w-sm items-center gap-x-4 rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
        <img class="size-12 shrink-0" src="/img/logo.svg" alt="ChitChat Logo" />
        <div>
            <div class="text-xl font-medium text-black dark:text-white">ChitChat</div>
            <p class="text-gray-500 dark:text-gray-400">You have a new message!</p>
        </div>
    </div>
</body>

</html>

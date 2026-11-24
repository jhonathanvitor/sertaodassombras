<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Sertão das Sombras — Terror folclórico brasileiro | Expiai' }}</title>
    <meta name="description" content="Sertão das Sombras: terror psicológico e folclórico em primeira pessoa, ambientado num vilarejo abandonado do Cerrado mato-grossense. Download gratuito para Windows." />
    <meta property="og:title" content="Sertão das Sombras" />
    <meta property="og:description" content="Algumas lendas do Cerrado nunca dormem. Elas esperam você entrar na mata." />
    <meta property="og:type" content="website" />
    <meta name="theme-color" content="#0A0A0C" />

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Ícones Lucide -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head>
<body class="grain bg-abyss text-bone antialiased overflow-x-hidden">
    {{ $slot }}

    @livewireScripts
</body>
</html>

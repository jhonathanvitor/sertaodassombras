<?php

return [
    'title' => env('SERTAO_TITLE', 'Sertão das Sombras'),
    'studio' => env('SERTAO_STUDIO', 'Expiai'),
    'tagline' => 'Algumas lendas do Cerrado nunca dormem. Elas esperam você entrar na mata.',
    'version' => env('SERTAO_VERSION', 'v1.0 - Build Oficial'),
    'engine' => 'Godot Engine 4.6',
    'email' => env('SERTAO_EMAIL', 'majonescode@gmail.com'),
    'copyright' => '© 2026 Expiai / Jhonathan Vitor da Silva Costa LTDA. Todos os direitos reservados.',
    'grant_text' => 'Projeto contemplado pelo Edital nº 23/2024/SECEL/MT – Cinemotion Audiovisual (PNAB – Política Nacional Aldir Blanc de Fomento à Cultura).',

    'links' => [
        'download_windows' => env('SERTAO_DOWNLOAD_WINDOWS', 'https://SEU-LINK-AQUI/SertaoDasSombras_v1.0_Windows.exe'),
        'download_linux' => env('SERTAO_DOWNLOAD_LINUX', 'https://SEU-LINK-AQUI/SertaoDasSombras_v1.0_Linux.x86_64'),
        'itch' => env('SERTAO_ITCH_URL', 'https://expiai.itch.io/sertao-das-sombras'),
        'github' => env('SERTAO_GITHUB_URL', 'https://github.com/SEU-USUARIO/sertao-das-sombras/releases'),
        'youtube_id' => env('SERTAO_YOUTUBE_ID', 'dQw4w9WgXcQ'),
        'instagram' => env('SERTAO_INSTAGRAM_URL', '#'),
        'youtube' => env('SERTAO_YOUTUBE_URL', '#'),
        'twitter' => env('SERTAO_TWITTER_URL', '#'),
    ],

    'pillars' => [
        [
            'icon' => 'flame',
            'title' => 'Terror Folclórico Autêntico',
            'description' => 'Criaturas e mitos enraizados na cultura de Mato Grosso e do Brasil, como o Curupira e a Mãe do Ouro.',
        ],
        [
            'icon' => 'audio-waveform',
            'title' => 'Imersão Sonora Regional',
            'description' => 'Trilha original de suspense sombrio com percussão brasileira e o som hipnótico e tenso do berimbau.',
        ],
        [
            'icon' => 'flashlight',
            'title' => 'Exploração em Primeira Pessoa',
            'description' => 'Atmosfera densa, lanterna limitada, documentos antigos e uma narrativa contada pelo próprio ambiente.',
        ],
    ],

    'lore' => [
        [
            'id' => 1,
            'code' => 'ARQUIVO I · 1987',
            'icon' => 'home',
            'title' => 'O Vilarejo Abandonado',
            'summary' => 'O que restou das casas de adobe e das veredas esquecidas.',
            'fragment' => '“As portas ficaram abertas, como se todos tivessem saído às pressas. Ninguém voltou para buscar as panelas no fogão.”',
            'offset' => false,
        ],
        [
            'id' => 2,
            'code' => 'ARQUIVO II · RELATOS ORAIS',
            'icon' => 'trees',
            'title' => 'As Vozes da Mata',
            'summary' => 'Lendas locais sobre guardiões da floresta e luzes enganosas no horizonte.',
            'fragment' => '“Quem segue a luz dourada depois da meia-noite volta com os bolsos vazios — quando volta. E as pegadas na areia apontam para o lado errado.”',
            'offset' => true,
        ],
        [
            'id' => 3,
            'code' => 'ARQUIVO III · CORRESPONDÊNCIA',
            'icon' => 'mail',
            'title' => 'Cartas do Passado',
            'summary' => 'Pistas deixadas para trás que conectam o protagonista à maldição do lugar.',
            'fragment' => '“Se esta carta chegar até você, não venha. O que seu avô prometeu à mata ainda não foi pago.”',
            'offset' => false,
        ],
    ],

    'screenshots' => [
        ['src' => '', 'caption' => 'A entrada do vilarejo ao anoitecer', 'hue' => 'amber'],
        ['src' => '', 'caption' => 'Casa de adobe — o quarto do avô', 'hue' => 'blood'],
        ['src' => '', 'caption' => 'Vereda sob o luar', 'hue' => 'mist'],
        ['src' => '', 'caption' => 'Luzes enganosas no horizonte', 'hue' => 'amber'],
        ['src' => '', 'caption' => 'Documentos antigos à luz da lanterna', 'hue' => 'blood'],
        ['src' => '', 'caption' => 'A mata fechada', 'hue' => 'mist'],
    ],

    'requirements' => [
        [
            'component' => 'Sistema',
            'min' => 'Windows 10/11 64-bit',
            'min_sub' => 'Linux 64-bit (x86_64)',
            'rec' => 'Windows 10/11 64-bit',
            'rec_sub' => 'Linux 64-bit (x86_64)',
        ],
        [
            'component' => 'Processador',
            'min' => 'Intel Core i5 / AMD Ryzen 5',
            'min_sub' => null,
            'rec' => 'Intel Core i5 / AMD Ryzen 5 ou superior',
            'rec_sub' => null,
        ],
        [
            'component' => 'Memória',
            'min' => '8 GB RAM',
            'min_sub' => null,
            'rec' => '16 GB RAM',
            'rec_sub' => null,
        ],
        [
            'component' => 'Placa de vídeo',
            'min' => 'GTX 1050 Ti / RX 570',
            'min_sub' => null,
            'rec' => 'RTX 3050 ou superior',
            'rec_sub' => null,
        ],
        [
            'component' => 'API gráfica',
            'min' => 'DirectX 12 / Vulkan',
            'min_sub' => 'Linux: Vulkan',
            'rec' => 'DirectX 12 / Vulkan',
            'rec_sub' => 'Linux: Vulkan',
        ],
        [
            'component' => 'Armazenamento',
            'min' => '~2.5 GB livres',
            'min_sub' => null,
            'rec' => '~2.5 GB livres em SSD',
            'rec_sub' => null,
        ],
    ],

    'team' => [
        ['name' => 'Jhonathan Vitor', 'role' => 'Direção Geral, Game Design & Programação', 'note' => 'Expiai', 'icon' => 'compass', 'photo' => ''],
        ['name' => 'Kellen Nascimento', 'role' => 'Produtora', 'note' => '', 'icon' => 'clapperboard', 'photo' => ''],
        ['name' => 'Mikael Maia', 'role' => 'Roteiro', 'note' => '', 'icon' => 'feather', 'photo' => ''],
        ['name' => 'Ribeiro Bordin', 'role' => 'Direção de Arte & Programação Júnior', 'note' => '', 'icon' => 'palette', 'photo' => ''],
        ['name' => 'Guilherme Aquino', 'role' => 'Produção Musical & Modelagem 3D', 'note' => '', 'icon' => 'music', 'photo' => ''],
    ],

    'sponsors' => [
        ['name' => 'Expiai', 'logo' => ''],
        ['name' => 'SECEL-MT', 'logo' => ''],
        ['name' => "Governo de\nMato Grosso", 'logo' => ''],
        ['name' => 'PNAB', 'logo' => ''],
        ['name' => "Ministério\nda Cultura", 'logo' => ''],
        ['name' => "Governo\nFederal", 'logo' => ''],
    ],
];

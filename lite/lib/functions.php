<?php

function load_games(): array {
    $path = __DIR__ . '/../games.json';
    if (!file_exists($path)) {
        return [];
    }
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        return [];
    }
    // Normalize and ensure required keys
    $normalized = [];
    foreach ($data as $item) {
        if (!is_array($item)) { continue; }
        $id = isset($item['id']) ? (string)$item['id'] : null;
        $name = isset($item['name']) ? (string)$item['name'] : '';
        $image = isset($item['image']) ? (string)$item['image'] : '';
        $description = isset($item['description']) ? (string)$item['description'] : '';
        $play_url = isset($item['play_url']) ? (string)$item['play_url'] : '';
        if ($id === null || $name === '' || $play_url === '') { continue; }
        $normalized[] = [
            'id' => $id,
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'play_url' => $play_url,
        ];
    }
    return $normalized;
}

function get_game_by_id(string $id): ?array {
    foreach (load_games() as $g) {
        if ($g['id'] === $id) { return $g; }
    }
    return null;
}

function render_layout(string $title, string $content): string {
    $titleSafe = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    return '<!doctype html>' .
        '<html lang="en">' .
        '<head>' .
        '<meta charset="utf-8" />' .
        '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />' .
        '<link rel="preconnect" href="https://api.gamemonetize.com" crossorigin />' .
        '<link rel="dns-prefetch" href="//api.gamemonetize.com" />' .
        '<link rel="preconnect" href="https://html5.gamemonetize.com" crossorigin />' .
        '<link rel="dns-prefetch" href="//html5.gamemonetize.com" />' .
        '<title>' . $titleSafe . '</title>' .
        '<style>' . base_styles() . '</style>' .
        // Preserve original ad/tracking loader (GameMonetize CMS script)
        '<script src="https://api.gamemonetize.com/cms.js?' . time() . '" defer></script>' .
        // Cookie consent similar to original theme behavior
        '<script>window.cookieconsent_options={"message":"This website uses cookies to ensure you get the best experience on our website.","dismiss":"Got it!","learnMore":"Learn more","link":"/privacy","target":"_blank","theme":"dark-bottom"};</script>' .
        '<script src="/templates/crazygames-like/js/cookieconsent.min.js"></script>' .
        '</head>' .
        '<body>' .
        '<header class="site-header"><a class="brand" href="./">GM Lite</a></header>' .
        $content .
        '</body></html>';
}

function base_styles(): string {
    return 'html{box-sizing:border-box}*,*:before,*:after{box-sizing:inherit}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#0f0f12;color:#fff;-webkit-font-smoothing:antialiased}a{color:inherit;text-decoration:none}img{max-width:100%;display:block} .site-header{position:sticky;top:0;background:#15151a;border-bottom:1px solid #23232a;padding:12px 16px;z-index:10} .brand{font-weight:600} .container{max-width:1040px;margin:0 auto;padding:16px} .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}@media (max-width:900px){.grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (max-width:600px){.grid{grid-template-columns:repeat(1,minmax(0,1fr))}} .card{background:#15151a;border:1px solid #23232a;border-radius:10px;overflow:hidden;display:flex;flex-direction:column} .thumb{aspect-ratio:5/3;background:#0b0b0f} .card-body{padding:12px;display:flex;flex-direction:column;gap:8px} .name{font-size:16px;font-weight:600;line-height:1.2} .desc{font-size:13px;color:#b8b8bf;line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden} .btn{display:inline-flex;align-items:center;justify-content:center;background:#3b82f6;color:#fff;border:none;border-radius:8px;padding:10px 12px;font-weight:600;cursor:pointer;transition:background .15s ease} .btn:active{transform:translateY(1px)} .btn:hover{background:#2563eb} .pagination{display:flex;gap:8px;align-items:center;justify-content:center;margin:16px 0} .page-link{padding:8px 10px;border:1px solid #23232a;border-radius:8px;background:#15151a} .page-link.active{background:#3b82f6;border-color:#3b82f6} .hero{padding:16px} .iframe-wrap{position:relative;width:100%;padding-top:56.25%;background:#000;border-bottom:1px solid #23232a} .iframe-wrap iframe{position:absolute;top:0;left:0;width:100%;height:100%;border:0} .detail{display:flex;flex-direction:column;gap:12px} .back{display:inline-block;margin-bottom:8px;color:#93c5fd}';
}

function render_game_card(array $g): string {
    $id = rawurlencode($g['id']);
    $name = htmlspecialchars($g['name'], ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($g['description'] ?? '', ENT_QUOTES, 'UTF-8');
    $img = htmlspecialchars($g['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $thumb = $img !== '' ? '<img class="thumb" src="' . $img . '" loading="lazy" alt="' . $name . '" />' : '<div class="thumb"></div>';
    return '<div class="card">' .
        $thumb .
        '<div class="card-body">' .
        '<div class="name">' . $name . '</div>' .
        '<div class="desc">' . $desc . '</div>' .
        '<div><a class="btn" href="?r=play&id=' . $id . '">Play</a></div>' .
        '</div></div>';
}

function render_game_list(array $items, int $page, int $totalPages): string {
    $cards = array_map('render_game_card', $items);
    $grid = '<div class="grid">' . implode('', $cards) . '</div>';
    $pager = render_pagination($page, $totalPages);
    return '<main class="container">' . $grid . $pager . '</main>';
}

function render_pagination(int $page, int $totalPages): string {
    if ($totalPages <= 1) { return ''; }
    $links = [];
    $prev = max(1, $page - 1);
    $next = min($totalPages, $page + 1);
    $links[] = '<a class="page-link" href="?page=' . $prev . '">Prev</a>';
    // windowed pagination, up to 5 links centered
    $window = 2;
    $start = max(1, $page - $window);
    $end = min($totalPages, $page + $window);
    for ($i = $start; $i <= $end; $i++) {
        $active = $i === $page ? ' active' : '';
        $links[] = '<a class="page-link' . $active . '" href="?page=' . $i . '">' . $i . '</a>';
    }
    $links[] = '<a class="page-link" href="?page=' . $next . '">Next</a>';
    return '<nav class="pagination">' . implode('', $links) . '</nav>';
}

function render_game_detail(array $g): string {
    $name = htmlspecialchars($g['name'], ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($g['description'] ?? '', ENT_QUOTES, 'UTF-8');
    $img = htmlspecialchars($g['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $play = htmlspecialchars($g['play_url'], ENT_QUOTES, 'UTF-8');
    $thumb = $img !== '' ? '<img class="thumb" src="' . $img . '" loading="lazy" alt="' . $name . '" />' : '';
    $button = '<button class="btn" id="gm-play-btn">Play</button>';
    $shell = '<div class="iframe-wrap" id="gm-iframe-wrap" data-src="' . $play . '"></div>';
    $script = '<script>(function(){var b=document.getElementById("gm-play-btn");if(!b)return;var w=document.getElementById("gm-iframe-wrap");b.addEventListener("click",function(){if(!w||w.getAttribute("data-loaded"))return;var src=w.getAttribute("data-src");var f=document.createElement("iframe");f.setAttribute("src",src);f.setAttribute("loading","lazy");f.setAttribute("allow","autoplay; fullscreen");f.setAttribute("allowfullscreen","true");f.style.border="0";f.style.position="absolute";f.style.top="0";f.style.left="0";f.style.width="100%";f.style.height="100%";w.appendChild(f);w.setAttribute("data-loaded","1");b.parentNode.removeChild(b);});})();</script>';
    return '<main class="container">' .
        '<a class="back" href="./">← Back</a>' .
        '<div class="detail">' .
        $thumb .
        '<h1 class="name">' . $name . '</h1>' .
        '<p class="desc">' . $desc . '</p>' .
        $button .
        $shell .
        $script .
        '</div>' .
        '</main>';
}



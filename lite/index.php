<?php
// Minimal, DB-less entrypoint for a lightweight game list/detail

// Force UTF-8 and simple caching headers (aggressive caching disabled for WebView freshness)
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

require __DIR__ . '/lib/functions.php';

$route = isset($_GET['r']) ? trim($_GET['r']) : 'list';

if ($route === 'play') {
    $id = isset($_GET['id']) ? (string)$_GET['id'] : '';
    $game = get_game_by_id($id);
    if ($game === null) {
        http_response_code(404);
        echo render_layout('Not found', '<div class="container"><p>Game not found.</p></div>');
        exit;
    }

    $content = render_game_detail($game);
    echo render_layout(htmlspecialchars($game['name'], ENT_QUOTES, 'UTF-8'), $content);
    exit;
}

// default: list with pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 30;

$allGames = load_games();
$total = count($allGames);
$start = ($page - 1) * $perPage;
$items = array_slice($allGames, $start, $perPage);

$content = render_game_list($items, $page, (int)ceil($total / $perPage));
echo render_layout('Games', $content);



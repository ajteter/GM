GM Lite (DB-less)

A minimal, database-free mode for ultra-fast mobile WebView deployment.

Features
- JSON-powered game catalog (`lite/games.json`)
- Paginated game list (30 per page)
- Simple game detail with embedded play iframe
- Single-file CSS inlined for speed; responsive & touch-friendly

Run
1. Ensure PHP 7.4+.
2. Serve the `lite/` directory as document root or visit `/lite/index.php` under the existing root.

Examples:
- Built-in server from project root:
  ```bash
  php -S 0.0.0.0:8080 -t .
  ```
  Then open `http://localhost:8080/lite/index.php`.

Data
Edit `lite/games.json` to add games:
```json
[
  {
    "id": "unique-id",
    "name": "Game Name",
    "image": "/path/to/thumb.webp",
    "description": "Short description...",
    "play_url": "https://example.com/game/index.html"
  }
]
```

Notes
- No database, cookies, or external blockers. Ideal for embedded app WebViews.
- Keep thumbnails optimized (WebP) and host iframes on fast CDNs for best UX.



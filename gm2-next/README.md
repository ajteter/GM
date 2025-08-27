GM2 Next (Rewrite)

Tech: Next.js (App Router), React 18
Features: JSON-powered list (30/page), detail play with click-to-load iframe
Ads/Tracking: Injects https://api.gamemonetize.com/cms.js and cookie consent, with preconnect/dns-prefetch

Develop
```
cd gm2-next
npm i
npm run dev
```

Deploy (Vercel)
- Framework preset: Next.js
- Build command: npm run build
- Output: .next
- Ensure public/ads.txt is present (copy original ads.txt lines)

Data
- Edit public/games.json to add games.


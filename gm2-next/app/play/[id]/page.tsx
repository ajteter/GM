'use client'
import { useMemo, useState, useEffect } from 'react'
import { games } from '../../games'
import Link from 'next/link'

export default function PlayPage({ params }: { params: { id: string } }) {
  const game = useMemo(() => (games as any[]).find(g => g.id === params.id), [params.id])
  const [loaded, setLoaded] = useState(false)

  useEffect(() => {
    if (loaded && game) {
      const scriptId = 'gamemonetize-video-api';
      if (document.getElementById(scriptId)) return;

      const script = document.createElement('script');
      script.id = scriptId;
      script.src = `https://api.gamemonetize.com/video.js?v=${Date.now()}`;
      script.async = true;
      document.head.appendChild(script);

      (window as any).VIDEO_OPTIONS = {
        gameid: game.id,
        width: "100%",
        height: "100%",
        color: "#3f007e"
      };
    }
  }, [loaded, game]);

  if (!game) {
    return <main className="container"><p>Game not found.</p></main>
  }

  return (
    <main className="container">
      <Link className="back" href="/">← Back</Link>
      <div className="detail">
        {game.image ? <img className="thumb" src={game.image} loading="lazy" alt={game.name} /> : null}
        <h1 className="name">{game.name}</h1>
        <p className="desc">{game.description || ''}</p>
        {!loaded && <button className="btn" onClick={() => setLoaded(true)}>Play</button>}
        <div className="iframe-wrap">
          {loaded && <iframe src={game.play_url} loading="lazy" allow="autoplay; fullscreen" allowFullScreen />}
        </div>
      </div>
    </main>
  )
}



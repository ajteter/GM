'use client'
import { useMemo, useState } from 'react'
import games from '../../../public/games.json'
import Link from 'next/link'

export default function PlayPage({ params }: { params: { id: string } }) {
  const game = useMemo(() => (games as any[]).find(g => g.id === params.id), [params.id])
  const [loaded, setLoaded] = useState(false)
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



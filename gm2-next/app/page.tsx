import Link from 'next/link'
import games from '../public/games.json'

const PER_PAGE = 30

export default function Home({ searchParams }: { searchParams?: { page?: string } }) {
  const page = Math.max(1, parseInt(searchParams?.page ?? '1', 10) || 1)
  const start = (page - 1) * PER_PAGE
  const items = (games as any[]).slice(start, start + PER_PAGE)
  const totalPages = Math.ceil((games as any[]).length / PER_PAGE)

  return (
    <main className="container">
      <div className="grid">
        {items.map((g: any) => (
          <div className="card" key={g.id}>
            {g.image ? <img className="thumb" src={g.image} loading="lazy" alt={g.name} /> : <div className="thumb" />}
            <div className="card-body">
              <div className="name">{g.name}</div>
              <div className="desc">{g.description || ''}</div>
              <div>
                <Link className="btn" href={`/play/${encodeURIComponent(g.id)}`}>Play</Link>
              </div>
            </div>
          </div>
        ))}
      </div>
      <nav className="pagination">
        <Link className="page-link" href={`/?page=${Math.max(1, page-1)}`}>Prev</Link>
        {Array.from({ length: Math.min(5, totalPages) }, (_, i) => {
          const center = Math.max(1, Math.min(page - 2, totalPages - 4))
          const p = center + i
          if (p > totalPages) return null
          return <Link key={p} className={`page-link${p===page?' active':''}`} href={`/?page=${p}`}>{p}</Link>
        })}
        <Link className="page-link" href={`/?page=${Math.min(totalPages, page+1)}`}>Next</Link>
      </nav>
    </main>
  )
}



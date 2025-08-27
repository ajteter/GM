export const metadata = {
  title: '',
  description: '',
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <link rel="preconnect" href="https://api.gamemonetize.com" crossOrigin="anonymous" />
        <link rel="dns-prefetch" href="//api.gamemonetize.com" />
        <link rel="preconnect" href="https://html5.gamemonetize.com" crossOrigin="anonymous" />
        <link rel="dns-prefetch" href="//html5.gamemonetize.com" />
        <script defer src={`https://api.gamemonetize.com/cms.js?${Date.now()}`}></script>
        <script dangerouslySetInnerHTML={{__html: `window.cookieconsent_options={"message":"This website uses cookies to ensure you get the best experience on our website.","dismiss":"Got it!","learnMore":"Learn more","link":"/privacy","target":"_blank","theme":"dark-bottom"};`}} />
        <script src="/templates/crazygames-like/js/cookieconsent.min.js"></script>
        <style>{`
          html{box-sizing:border-box}*,*:before,*:after{box-sizing:inherit}
          body{margin:0;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#0f0f12;color:#fff}
          a{color:inherit;text-decoration:none}
          img{max-width:100%;display:block}
          .site-header{position:sticky;top:0;background:#15151a;border-bottom:1px solid #23232a;padding:12px 16px;z-index:10}
          .brand{font-weight:600}
          .container{max-width:1040px;margin:0 auto;padding:16px}
          .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}
          @media (max-width:900px){.grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
          @media (max-width:600px){.grid{grid-template-columns:repeat(1,minmax(0,1fr))}}
          .card{background:#15151a;border:1px solid #23232a;border-radius:10px;overflow:hidden;display:flex;flex-direction:column}
          .thumb{aspect-ratio:5/3;background:#0b0b0f}
          .card-body{padding:12px;display:flex;flex-direction:column;gap:8px}
          .name{font-size:16px;font-weight:600;line-height:1.2}
          .desc{font-size:13px;color:#b8b8bf;line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
          .btn{display:inline-flex;align-items:center;justify-content:center;background:#3b82f6;color:#fff;border:none;border-radius:8px;padding:10px 12px;font-weight:600;cursor:pointer}
          .pagination{display:flex;gap:8px;align-items:center;justify-content:center;margin:16px 0}
          .page-link{padding:8px 10px;border:1px solid #23232a;border-radius:8px;background:#15151a}
          .page-link.active{background:#3b82f6;border-color:#3b82f6}
          .iframe-wrap{position:relative;width:100%;padding-top:56.25%;background:#000;border-bottom:1px solid #23232a}
          .iframe-wrap iframe{position:absolute;top:0;left:0;width:100%;height:100%;border:0}
          .detail{display:flex;flex-direction:column;gap:12px}
          .back{display:inline-block;margin-bottom:8px;color:#93c5fd}
        `}</style>
      </head>
      <body>
        <header className="site-header"><a className="brand" href="/">GM2 Next</a></header>
        {children}
      </body>
    </html>
  );
}



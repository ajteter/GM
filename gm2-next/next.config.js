/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  experimental: {
    optimizePackageImports: [],
  },
  headers: async () => {
    return [
      {
        source: '/:all*.(png|jpg|jpeg|gif|webp|svg|ico|css|js|mp4)',
        headers: [
          { key: 'Cache-Control', value: 'public, max-age=31536000, immutable' }
        ]
      },
      {
        source: '/games.json',
        headers: [
          { key: 'Cache-Control', value: 'public, max-age=60, stale-while-revalidate=300' }
        ]
      }
    ];
  }
};

module.exports = nextConfig;


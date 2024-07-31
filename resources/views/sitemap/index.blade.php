<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('login') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('sales') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('sales-50') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('novinki') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('cart') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('cart.login') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('brands') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    @foreach ($brands as $brand)
        <url>
            <loc>{{ route('brands.show', $brand->link) }}</loc>
            <lastmod>{{ $brand->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ route('categories.show', $category->alias) }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($products as $product)
        <url>
            <loc>{{ route('products.product', $product->alias) }}</loc>
            <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($pages as $page)
        <url>
            <loc>{{ route('pages.show', $page->link) }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ route('news.index') }}</loc>
        <lastmod>2024-07-18T21:00:00+00:00</lastmod>
        <priority>1.0</priority>
    </url>
    @foreach ($news as $article)
        <url>
            <loc>{{ route('news.post', $article->link) }}</loc>
            <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($banners as $banner)
        <url>
            <loc>{{ route('index.banner', $banner->link) }}</loc>
            <lastmod>{{ $banner->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>

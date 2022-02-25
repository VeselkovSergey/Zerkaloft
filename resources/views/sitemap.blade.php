<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($categories as $category)
        <url>
            <loc>{{route('category', $category->semantic_url)}}</loc>
            <lastmod>{{$category->updated_at}}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
        @foreach($category->Products as $product)
            <url>
                <loc>{{$product->Link()}}</loc>
                <lastmod>{{$product->updated_at}}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endforeach
</urlset>
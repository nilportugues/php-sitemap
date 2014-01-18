<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($pages as $page) { ?>
     <url>
       <loc><?php echo $page['url']; ?></loc><!-- page where it's used -->
       <lastmod><?php echo $page['updated_at']; ?></lastmod>
       <changefreq><?php echo $page['changefreq']; ?></changefreq><!-- this should be calculated in the model by reading the updated_at log-->
       <priority><?php echo $page['priority']; ?></priority>

        <!-- image data used in loc page -->
        <?php foreach ($page['images'] as $image) { ?>
        <image:image>
            <?php if (!empty($image['loc']) {?><image:loc><?php echo $image['loc']; ?></image:loc> <?php } ?>
            <?php if (!empty($image['title']) {?><image:title><![CDATA[<?php echo $image['title']; ?>]]></image:title><?php } ?>
            <?php if (!empty($image['caption']) {?><image:caption><![CDATA[<?php echo $image['caption']; ?>]]></image:caption><?php } ?>
            <?php if (!empty($image['geolocation']) {?><image:geolocation><![CDATA[<?php echo $image['geolocation']; ?>]]></image:geolocation><?php } ?>
            <?php if (!empty($image['license']) {?><image:license><![CDATA[<?php echo $image['license']; ?>]]></image:license><?php } ?>
        </image:image>
        <?php } ?>

    </url>

<?php } ?>
</urlset>

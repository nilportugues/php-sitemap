<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;


/**
 * Class VideoItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class VideoItem extends AbstractItem
{
    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</urlset>";
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function buildItem()
    {
        //Create item ONLY if all mandatory data is present.
        if( !empty($this->data['title']) && (!empty($this->data['player_loc']) || !empty($this->data['content_loc']))  )
        {
            $xml = array();

            $xml[] = "\t\t".'<video:video>';
            $xml[] = (!empty($this->data['thumbnail_loc']))     ? "\t\t\t".'<video:thumbnail_loc><![CDATA['.$this->data['thumbnail_loc'].']]></video:thumbnail_loc>' : '';
            $xml[] = (!empty($this->data['title']))             ? "\t\t\t".'<video:title><![CDATA['.$this->data['title'].']]></video:title>' : '';
            $xml[] = (!empty($this->data['description']))       ? "\t\t\t".'<video:description><![CDATA['.$this->data['description'].']]></video:description>' : '';
            $xml[] = (!empty($this->data['content_loc']))       ? "\t\t\t".'<video:content_loc><![CDATA['.$this->data['content_loc'].']]></video:content_loc>' : '';

            if(!empty($this->data['player_loc']) && !empty($this->data['allow_embed']) && !empty($this->data['autoplay']))
            {
                $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'" autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
            }
            elseif(!empty($this->data['player_loc']) && !empty($this->data['allow_embed']) )
            {
                $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'" >'.$this->data['player_loc'].'</video:player_loc>';
            }
            elseif(!empty($this->data['player_loc']) && !empty($this->data['autoplay']) )
            {
                $xml[] = "\t\t\t".'<video:player_loc autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
            }

            $xml[] = (!empty($this->data['duration']))          ? "\t\t\t".'<video:duration><![CDATA['.$this->data['duration'].']]></video:duration>' : '';
            $xml[] = (!empty($this->data['expiration_date']))   ? "\t\t\t".'<video:expiration_date><![CDATA['.$this->data['expiration_date'].']]></video:expiration_date>' : '';
            $xml[] = (!empty($this->data['rating']))            ? "\t\t\t".'<video:rating><![CDATA['.$this->data['rating'].']]></video:rating>' : '';
            $xml[] = (!empty($this->data['view_count']))        ? "\t\t\t".'<video:view_count><![CDATA['.$this->data['view_count'].']]></video:view_count>' : '';
            $xml[] = (!empty($this->data['publication_date']))  ? "\t\t\t".'<video:publication_date><![CDATA['.$this->data['publication_date'].']]></video:publication_date>' : '';
            $xml[] = (!empty($this->data['family_friendly']))   ? "\t\t\t".'<video:family_friendly><![CDATA['.$this->data['family_friendly'].']]></video:family_friendly>' : '';


            if(!empty($this->data['restriction']) && !empty($this->data['restriction_relationship']) )
            {
                $xml[] = "\t\t\t".'<video:restriction relationship="'.$this->data['restriction_relationship'].'">'.$this->data['restriction'].'</video:restriction>';
            }
            elseif(!empty($this->data['restriction']) )
            {
                $xml[] = "\t\t\t".'<video:restriction>'.$this->data['restriction'].'</video:restriction>';
            }


            if(!empty($this->data['gallery_loc']) && !empty($this->data['gallery_loc_title']))
            {
                $xml[] = "\t\t\t".'<video:gallery_loc title="'.$this->data['gallery_loc_title'].'">'.$this->data['gallery_loc'].'</video:gallery_loc>';
            }
            elseif(!empty($this->data['gallery_loc']) )
            {
                $xml[] = "\t\t\t".'<video:gallery_loc>'.$this->data['gallery_loc'].'</video:gallery_loc>';
            }

            //Loop price array
            foreach($this->data['price'] as $price)
            {
                if(!empty($price['price']) && !empty($price['price_currency']))
                {
                    $xml[] = "\t\t\t".'<video:price title="'.$price['price_currency'].'">'.$price['gallery_loc'].'</video:price>';
                }
                elseif(!empty($price['price']) )
                {
                    $xml[] = "\t\t\t".'<video:price>'.$price['price'].'</video:price>';
                }
            }

            $xml[] = (!empty($this->data['category']))          ? "\t\t\t".'<video:category><![CDATA['.$this->data['category'].']]></video:category>' : '';

            //Loop tag array
            foreach($this->data['tag'] as $tag)
            {
               $xml[] = "\t\t\t".'<video:tag>'.$tag.'</video:tag>';
            }

            $xml[] = (!empty($this->data['requires_subscription']))  ? "\t\t\t".'<video:requires_subscription><![CDATA['.$this->data['requires_subscription'].']]></video:requires_subscription>' : '';



            if(!empty($this->data['uploader']) && !empty($this->data['uploader_info']))
            {
                $xml[] = "\t\t\t".'<video:uploader info="'.$this->data['uploader_info'].'">'.$this->data['uploader'].'</video:uploader>';
            }
            elseif(!empty($this->data['uploader']) )
            {
                $xml[] = "\t\t\t".'<video:uploader>'.$this->data['uploader'].'</video:uploader>';
            }

            $xml[] = (!empty($this->data['live']))              ? "\t\t\t".'<video:live><![CDATA['.$this->data['live'].']]></video:live>' : '';

            $xml[] = "\t\t".'</video:video>';


            //Clean up and return
            $xml = array_filter($xml);
            return implode("\n",$xml);
        }
        return '';
    }
}
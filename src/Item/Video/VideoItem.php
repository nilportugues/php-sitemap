<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class VideoItem
 * @package NilPortugues\Sitemap\Items
 */
class VideoItem extends AbstractItem
{
    /**
     * @var VideoItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     * @param $title
     * @param $contentLoc
     * @param $playerLoc
     * @param $playerEmbedded
     * @param $playerAutoplay
     */
    public function __construct($title, $contentLoc, $playerLoc, $playerEmbedded = null, $playerAutoplay = null)
    {
        $this->validator = VideoItemValidator::getInstance();
        $this->xml       = $this->reset();
        $this->setTitle($title);
        $this->setContentLoc($contentLoc);
        $this->setPlayerLoc($playerLoc, $playerEmbedded, $playerAutoplay);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t\t".'<video:video>',
            'thumbnail_loc'         => '',
            'title'                 => '',
            'description'           => '',
            'content_loc'           => '',
            'player_loc'            => '',
            'duration'              => '',
            'expiration_date'       => '',
            'rating'                => '',
            'view_count'            => '',
            'publication_date'      => '',
            'family_friendly'       => '',
            'restriction'           => '',
            'gallery_loc'           => '',
            'price'                 => '',
            'category'              => '',
            'tag'                   => '',
            'requires_subscription' => '',
            'uploader'              => '',
            'platform'              => '',
            'live'                  => '',
            "\t\t".'</video:video>',
        ];
    }

    /**
     * @param $title
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            true,
            'video:title',
            $this->validator,
            'validateTitle',
            $this->exception,
            'Provided title value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $loc
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setContentLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'content_loc',
            true,
            'video:content_loc',
            $this->validator,
            'validateLoc',
            $this->exception,
            'Provided content URL is not a valid.'
        );

        return $this;
    }

    /**
     * @param $loc
     *
     * @param $playerEmbedded
     * @param $playerAutoPlay
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLoc($loc, $playerEmbedded, $playerAutoPlay)
    {
        $this->validateInput(
            $loc,
            $this->validator,
            'validatePlayerLoc',
            $this->exception,
            'Provided player URL is not a valid value.'
        );

        $this->xml['player_loc'] .= '<video:player_loc';
        $this->setPlayerEmbedded($playerEmbedded);
        $this->setPlayerAutoPlay($playerAutoPlay);

        $this->xml['player_loc'] .= '>'.$loc.'</video:player_loc>';

        return $this;
    }

    /**
     * @param $playerEmbedded
     *
     * @throws VideoItemException
     */
    protected function setPlayerEmbedded($playerEmbedded)
    {
        if (null !== $playerEmbedded) {
            $this->writeAttribute(
                $playerEmbedded,
                'player_loc',
                'allow_embed',
                $this->validator,
                'validateAllowEmbed',
                $this->exception,
                'Provided player allow embed is not a valid value.'
            );
        }
    }

    /**
     * @param $playerAutoplay
     *
     * @throws VideoItemException
     */
    protected function setPlayerAutoPlay($playerAutoplay)
    {
        if (null !== $playerAutoplay) {
            $this->writeAttribute(
                $playerAutoplay,
                'player_loc',
                'autoplay',
                $this->validator,
                'validateAutoPlay',
                $this->exception,
                'Provided player autoplay is not a valid value.'
            );
        }
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n"
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
        .' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $loc
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setThumbnailLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'thumbnail_loc',
            true,
            'video:thumbnail_loc',
            $this->validator,
            'validateThumbnailLoc',
            $this->exception,
            'Provided thumbnail URL is not a valid.'
        );

        return $this;
    }

    /**
     * @param $description
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setDescription($description)
    {
        $this->writeFullTag(
            $description,
            'description',
            true,
            'video:description',
            $this->validator,
            'validateDescription',
            $this->exception,
            'Provided description value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $duration
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->writeFullTag(
            $duration,
            'duration',
            true,
            'video:duration',
            $this->validator,
            'validateDuration',
            $this->exception,
            'Provided duration value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $expirationDate
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $this->writeFullTag(
            $expirationDate,
            'expiration_date',
            true,
            'video:expiration_date',
            $this->validator,
            'validateExpirationDate',
            $this->exception,
            'Provided expiration date value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $rating
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRating($rating)
    {
        $this->writeFullTag(
            $rating,
            'rating',
            true,
            'video:rating',
            $this->validator,
            'validateRating',
            $this->exception,
            'Provided rating value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $viewCount
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        $this->writeFullTag(
            $viewCount,
            'view_count',
            true,
            'video:view_count',
            $this->validator,
            'validateViewCount',
            $this->exception,
            'Provided view count value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $publicationDate
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPublicationDate($publicationDate)
    {
        $this->writeFullTag(
            $publicationDate,
            'publication_date',
            true,
            'video:publication_date',
            $this->validator,
            'validatePublicationDate',
            $this->exception,
            'Provided publication date value is not a valid.'
        );

        return $this;
    }

    /**
     * @param $familyFriendly
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        $this->writeFullTag(
            $familyFriendly,
            'family_friendly',
            true,
            'video:family_friendly',
            $this->validator,
            'validateFamilyFriendly',
            $this->exception,
            'Provided family friendly value is not a valid.'
        );

        return $this;
    }

    /**
     * @param      $restriction
     * @param null $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRestriction($restriction, $relationship = null)
    {
        $this->validateInput(
            $restriction,
            $this->validator,
            'validateRestriction',
            $this->exception,
            'Provided restriction is not a valid value.'
        );

        $this->xml['restriction'] = "\t\t\t".'<video:restriction';
        $this->setRestrictionRelationship($relationship);
        $this->xml['restriction'] .= '>'.$restriction.'</video:restriction>';

        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRestrictionRelationship($relationship)
    {
        if (null !== $relationship) {
            $this->writeAttribute(
                $relationship,
                'restriction',
                'relationship',
                $this->validator,
                'validateRestriction',
                $this->exception,
                'Provided restriction relationship is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param      $galleryLoc
     * @param null $title
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setGalleryLoc($galleryLoc, $title = null)
    {
        $this->validateInput(
            $galleryLoc,
            $this->validator,
            'validateGalleryLoc',
            $this->exception,
            'Provided gallery URL is not a valid value.'
        );

        $this->xml['gallery_loc'] = "\t\t\t".'<video:gallery_loc';
        $this->setGalleryTitle($title);
        $this->xml['gallery_loc'] .= '>'.$galleryLoc.'</video:gallery_loc>';

        return $this;
    }

    /**
     * @param $title
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setGalleryTitle($title)
    {
        if (null !== $title) {
            $this->writeAttribute(
                $title,
                'gallery_loc',
                'title',
                $this->validator,
                'validateGalleryLocTitle',
                $this->exception,
                'Provided gallery title is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param        $price
     * @param        $currency
     * @param string $type
     * @param string $resolution
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPrice($price, $currency, $type = null, $resolution = null)
    {
        $this->xml['price'] .= "\t\t\t".'<video:price';
        $this->setPriceValue($price);
        $this->setPriceCurrency($currency);
        $this->setPriceType($type);
        $this->setPriceResolution($resolution);
        $this->xml['price'] .= '>'.$price.'</video:price>'."\n";

        return $this;
    }

    /**
     * @param $price
     *
     * @throws VideoItemException
     */
    protected function setPriceValue($price)
    {
        $this->validateInput(
            $price,
            $this->validator,
            'validatePrice',
            $this->exception,
            'Provided price is not a valid value.'
        );
    }

    /**
     * @param   $currency
     *
     * @throws VideoItemException
     */
    protected function setPriceCurrency($currency)
    {
        $this->writeAttribute(
            $currency,
            'price',
            'currency',
            $this->validator,
            'validate',
            $this->exception,
            'Provided price currency is not a valid value.'
        );
    }

    /**
     * @param string|null $type
     *
     * @throws VideoItemException
     */
    protected function setPriceType($type)
    {
        if (null !== $type) {
            $this->writeAttribute(
                $type,
                'price',
                'type',
                $this->validator,
                'validatePriceType',
                $this->exception,
                'Provided price type is not a valid value.'
            );
        }
    }

    /**
     * @param string|null $resolution
     *
     * @throws VideoItemException
     */
    protected function setPriceResolution($resolution)
    {
        if (null !== $resolution) {
            $this->writeAttribute(
                $resolution,
                'price',
                'resolution',
                $this->validator,
                'validatePriceResolution',
                $this->exception,
                'Provided price resolution is not a valid value.'
            );
        }
    }

    /**
     * @param $category
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setCategory($category)
    {
        $this->writeFullTag(
            $category,
            'category',
            true,
            'video:category',
            $this->validator,
            'validateCategory',
            $this->exception,
            'Provided category value is not a valid.'
        );

        return $this;
    }

    /**
     * @param array $tag
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setTag(array $tag)
    {
        $this->validateInput(
            $tag,
            $this->validator,
            'validateTag',
            $this->exception,
            'Provided tag array is not a valid value.'
        );

        foreach ($tag as $tagName) {
            $this->xml['tag'] .= "\t\t\t".'<video:tag>'.$tagName.'</video:tag>'."\n";
        }

        return $this;
    }

    /**
     * @param $requires
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRequiresSubscription($requires)
    {
        $this->writeFullTag(
            $requires,
            'requires_subscription',
            true,
            'video:requires_subscription',
            $this->validator,
            'validateRequiresSubscription',
            $this->exception,
            'Provided requires subscription value is not a valid.'
        );

        return $this;
    }

    /**
     * @param      $uploader
     * @param null $info
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setUploader($uploader, $info = null)
    {
        $this->validateInput(
            $uploader,
            $this->validator,
            'validateUploader',
            $this->exception,
            'Provided uploader is not a valid value.'
        );

        $this->xml['uploader'] = "\t\t\t".'<video:uploader';
        $this->setUploaderInfo($info);
        $this->xml['uploader'] .= '>'.$uploader.'</video:uploader>';

        return $this;
    }

    /**
     * @param $info
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setUploaderInfo($info)
    {
        if (null !== $info) {
            $this->writeAttribute(
                $info,
                'uploader',
                'info',
                $this->validator,
                'validateUploaderInfo',
                $this->exception,
                'Provided uploader info is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param      $platform
     * @param null $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPlatform($platform, $relationship = null)
    {
        $this->validateInput(
            $platform,
            $this->validator,
            'validatePlatform',
            $this->exception,
            'Provided platform is not a valid value.'
        );

        $this->xml['platform'] = "\t\t\t".'<video:platform';
        $this->setPlatformRelationship($relationship);
        $this->xml['platform'] .= '>'.$platform.'</video:platform>';

        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlatformRelationship($relationship)
    {
        if (null !== $relationship) {
            $this->writeAttribute(
                $relationship,
                'platform',
                'relationship',
                $this->validator,
                'validatePlatformRelationship',
                $this->exception,
                'Provided relationship is not a valid value.'
            );
        }

        return $this;
    }

    /**
     * @param $live
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setLive($live)
    {
        $this->writeFullTag(
            $live,
            'live',
            true,
            'video:live',
            $this->validator,
            'validateLive',
            $this->exception,
            'Provided live value is not a valid.'
        );

        return $this;
    }
}

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
        $this->setPlayerLocValue($loc);
        $this->setPlayerEmbedded($playerEmbedded);
        $this->setPlayerAutoPlay($playerAutoPlay);

        $this->xml['player_loc'] .= '>'.$loc.'</video:player_loc>';

        return $this;
    }

    /**
     * @param $loc
     *
     * @return false|string
     * @throws VideoItemException
     */
    protected function setPlayerLocValue($loc)
    {
        $loc = $this->validator->validatePlayerLoc($loc);
        if (false === $loc) {
            throw new VideoItemException(
                sprintf('', $loc)
            );
        }
        $this->xml['player_loc'] .= '<video:player_loc';
    }

    /**
     * @param $playerEmbedded
     *
     * @throws VideoItemException
     */
    protected function setPlayerEmbedded($playerEmbedded)
    {
        if (null !== $playerEmbedded) {
            $playerEmbedded = $this->validator->validateAllowEmbed($playerEmbedded);
            if (false === $playerEmbedded) {
                throw new VideoItemException(
                    sprintf('', $playerEmbedded)
                );
            }
            $this->xml['player_loc'] .= ' allow_embed="'.$playerEmbedded.'"';
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
            $playerAutoplay = $this->validator->validateAutoPlay($playerAutoplay);
            if (false === $playerAutoplay) {
                throw new VideoItemException(
                    sprintf('', $playerAutoplay)
                );
            }
            $this->xml['player_loc'] .= ' autoplay="'.$playerAutoplay.'"';
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
        $restriction = $this->validator->validateRestriction($restriction);
        if (false === $restriction) {
            throw new VideoItemException(
                sprintf('', $restriction)
            );
        }

        $this->xml['restriction'] = "\t\t\t".'<video:restriction';

        if (null !== $relationship) {
            $this->setRestrictionRelationship($relationship);
        }

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
        $relationship = $this->validator->validateRestriction($relationship);
        if (false === $relationship) {
            throw new VideoItemException(
                sprintf('', $relationship)
            );
        }

        $this->xml['restriction'] .= ' relationship="'.$relationship.'">';

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
        $galleryLoc = $this->validator->validateGalleryLoc($galleryLoc);
        if (false === $galleryLoc) {
            throw new VideoItemException(
                sprintf('', $galleryLoc)
            );
        }
        $this->xml['gallery_loc'] = "\t\t\t".'<video:gallery_loc';

        if (null !== $title) {
            $this->setGalleryTitle($title);
        }
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
        $title = $this->validator->validateGalleryLocTitle($title);
        if (false === $title) {
            throw new VideoItemException(
                sprintf('', $title)
            );
        }

        $this->xml['gallery_loc'] .= ' title="'.$title.'"';

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
        $price = $this->validator->validatePrice($price);
        if (false === $price) {
            throw new VideoItemException(
                sprintf('', $price)
            );
        }
    }

    /**
     * @param   $currency
     *
     * @throws VideoItemException
     */
    protected function setPriceCurrency($currency)
    {
        $currency = $this->validator->validatePrice($currency);
        if (false === $currency) {
            throw new VideoItemException(
                sprintf('', $currency)
            );
        }
        $this->xml['price'] .= ' currency="'.$currency.'"';
    }

    /**
     * @param string|null $type
     *
     * @throws VideoItemException
     */
    protected function setPriceType($type)
    {
        if (null !== $type) {
            $type = $this->validator->validatePriceType($type);
            if (false === $type) {
                throw new VideoItemException(
                    sprintf('', $type)
                );
            }
            $this->xml['price'] .= ' type="'.$type.'"';
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
            $resolution = $this->validator->validatePriceResolution($resolution);
            if (false === $resolution) {
                throw new VideoItemException(
                    sprintf('', $resolution)
                );
            }
            $this->xml['price'] .= ' resolution="'.$resolution.'"';
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
        $tag = $this->validator->validateTag($tag);
        if (false === $tag) {
            throw new VideoItemException(
                sprintf('', implode(',', $tag))
            );
        }

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
        $uploader = $this->validator->validateUploader($uploader);
        if (false === $uploader) {
            throw new VideoItemException(
                sprintf('', $uploader)
            );
        }

        $this->xml['uploader'] = "\t\t\t".'<video:uploader';

        if (null !== $info) {
            $this->setUploaderInfo($info);
        }

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
        $info = $this->validator->validateUploaderInfo($info);
        if (false === $info) {
            throw new VideoItemException(
                sprintf('', $info)
            );
        }
        $this->xml['uploader'] .= ' info="'.$info;

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
        $platform = $this->validator->validatePlatform($platform);
        if (false === $platform) {
            throw new VideoItemException(
                sprintf('', $platform)
            );
        }

        $this->xml['platform'] = "\t\t\t".'<video:platform';

        if (null !== $relationship) {
            $this->setPlatformRelationship($relationship);
        }

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
        $relationship = $this->validator->validatePlatformRelationship($relationship);
        if (false === $relationship) {
            throw new VideoItemException(
                sprintf('', $relationship)
            );
        }
        $this->xml['platform'] .= ' relationship="'.$relationship.'"';

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

    /**
     * @param $embedded
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLocAllowEmbedded($embedded)
    {
        $embedded = $this->validator->validateAllowEmbed($embedded);
        if (false === $embedded) {
            throw new VideoItemException(
                sprintf('', $embedded)
            );
        }

        return $this;
    }

    /**
     * @param $autoPlay
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLocAutoPlay($autoPlay)
    {
        $autoPlay = $this->validator->validateAutoPlay($autoPlay);
        if (false === $autoPlay) {
            throw new VideoItemException(
                sprintf('', $autoPlay)
            );
        }

        return $this;
    }
}

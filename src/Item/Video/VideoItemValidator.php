<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:59 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\ValidatorTrait;
use NilPortugues\Sitemap\Item\Video\Validator\AllowDenyValidator;
use NilPortugues\Sitemap\Item\Video\Validator\DescriptionValidator;
use NilPortugues\Sitemap\Item\Video\Validator\DurationValidator;
use NilPortugues\Sitemap\Item\Video\Validator\FamilyFriendlyValidator;
use NilPortugues\Sitemap\Item\Video\Validator\PlatformValidator;
use NilPortugues\Sitemap\Item\Video\Validator\PriceAmountValidator;
use NilPortugues\Sitemap\Item\Video\Validator\PriceCurrencyValidator;
use NilPortugues\Sitemap\Item\Video\Validator\PriceResolutionValidator;
use NilPortugues\Sitemap\Item\Video\Validator\PriceTypeValidator;
use NilPortugues\Sitemap\Item\Video\Validator\RatingValidator;
use NilPortugues\Sitemap\Item\Video\Validator\RestrictionValidator;
use NilPortugues\Sitemap\Item\Video\Validator\TagValidator;
use NilPortugues\Sitemap\Item\Video\Validator\YesNoValidator;

/**
 * Class VideoItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class VideoItemValidator
{
    use ValidatorTrait;

    /**
     * @param $value
     *
     * @return string|false
     */
    public function validateAllowEmbed($value)
    {
        return YesNoValidator::validate($value);
    }

    /**
     * @param $string
     *
     * @return string|false
     */
    public function validateAutoPlay($string)
    {
        return self::validateString($string);
    }

    /**
     * @param $loc
     *
     * @return string|false
     */
    public function validateThumbnailLoc($loc)
    {
        return self::validateLoc($loc);
    }

    /**
     * @param $title
     *
     * @return boolean
     */
    public function validateTitle($title)
    {
        return self::validateString($title) && strlen($title) < 97;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     *
     * @return string|false
     */
    public function validateDescription($description)
    {
        return DescriptionValidator::validate($description);
    }

    /**
     * @param $contentLoc
     *
     * @return string|false
     */
    public function validateContentLoc($contentLoc)
    {
        return self::validateLoc($contentLoc);
    }

    /**
     * @param $playerLoc
     *
     * @return string|false
     */
    public function validatePlayerLoc($playerLoc)
    {
        return self::validateLoc($playerLoc);
    }

    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     *
     * @return bool|string
     */
    public function validateDuration($seconds)
    {
        return DurationValidator::validate($seconds);
    }

    /**
     * @param $expirationDate
     *
     * @return string|false
     */
    public function validateExpirationDate($expirationDate)
    {
        return self::validateDate($expirationDate);
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     *
     * @return string|false
     */
    public function validateRating($rating)
    {
        return RatingValidator::validate($rating);
    }

    /**
     * @param $viewCount
     *
     * @return bool|string
     */
    public function validateViewCount($viewCount)
    {
        return self::validateInteger($viewCount);
    }

    /**
     * @param $publicationDate
     *
     * @return string|false
     */
    public function validatePublicationDate($publicationDate)
    {
        return self::validateDate($publicationDate);
    }

    /**
     * @param $familyFriendly
     *
     * @return string|false
     */
    public function validateFamilyFriendly($familyFriendly)
    {
        return FamilyFriendlyValidator::validate($familyFriendly);
    }

    /**
     * @param $countries
     *
     * @return string|false
     */
    public function validateRestriction($countries)
    {
        return RestrictionValidator::validate($countries);
    }

    /**
     * @param $restrictionRelationship
     *
     * @return string|false
     */
    public function validateRestrictionRelationship($restrictionRelationship)
    {
        return $this->validateAllowDeny($restrictionRelationship);
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship"
     * specifies whether the video is restricted or permitted. Allowed values are allow or deny.
     *
     * @param $access
     *
     * @return string|false
     */
    protected function validateAllowDeny($access)
    {
        return AllowDenyValidator::validate($access);
    }

    /**
     * @param $galleryLoc
     *
     * @return string|false
     */
    public function validateGalleryLoc($galleryLoc)
    {
        return self::validateLoc($galleryLoc);
    }

    /**
     * @param $category
     *
     * @return string|false
     */
    public function validateCategory($category)
    {
        return self::validateString($category);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateGalleryLocTitle($title)
    {
        return self::validateString($title);
    }

    /**
     * @param $requiresSubscription
     *
     * @return string|false
     */
    public function validateRequiresSubscription($requiresSubscription)
    {
        return YesNoValidator::validate($requiresSubscription);
    }

    /**
     * @param $uploader
     *
     * @return string|false
     */
    public function validateUploader($uploader)
    {
        return self::validateString($uploader);
    }

    /**
     * @param $uploaderLoc
     *
     * @return string|false
     */
    public function validateUploaderInfo($uploaderLoc)
    {
        return self::validateLoc($uploaderLoc);
    }

    /**
     * @param $platform
     *
     * @return string|false
     */
    public function validatePlatform($platform)
    {
        return PlatformValidator::validate($platform);
    }

    /**
     * @param $platformAccess
     *
     * @return string|false
     */
    public function validatePlatformRelationship($platformAccess)
    {
        return AllowDenyValidator::validate($platformAccess);
    }

    /**
     * @param $live
     *
     * @return string|false
     */
    public function validateLive($live)
    {
        return YesNoValidator::validate($live);
    }

    /**
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     *
     * @return bool|array
     */
    public function validateTag($tags)
    {
        return TagValidator::validate($tags);
    }

    /**
     * @param $price
     *
     * @return bool
     */
    public function validatePrice($price)
    {
        return PriceAmountValidator::validate($price);
    }

    /**
     * @param $currency
     *
     * @return bool
     */
    public function validatePriceCurrency($currency)
    {
        return PriceCurrencyValidator::validate($currency);
    }

    /**
     * @param string $resolution
     *
     * @return string|false
     */
    public function validatePriceResolution($resolution)
    {
        return PriceResolutionValidator::validate($resolution);
    }

    /**
     * @param string $type
     *
     * @return string|false
     */
    public function validatePriceType($type)
    {
        return PriceTypeValidator::validate($type);
    }
}

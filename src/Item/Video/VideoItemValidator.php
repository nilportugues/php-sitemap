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

use NilPortugues\Sitemap\Item\SingletonTrait;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class VideoItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class VideoItemValidator
{
    use SingletonTrait;
    use ValidatorTrait;

    /**
     * @var int
     */
    protected $maxVideoTagTags = 32;

    /**
     * @var array
     */
    protected $iso3166 = array(
        //ISO 3166-1 ALPHA 2
        'AD',
        'AE',
        'AF',
        'AG',
        'AI',
        'AL',
        'AM',
        'AO',
        'AQ',
        'AR',
        'AS',
        'AT',
        'AU',
        'AW',
        'AX',
        'AZ',
        'BA',
        'BB',
        'BD',
        'BE',
        'BF',
        'BG',
        'BH',
        'BI',
        'BJ',
        'BL',
        'BM',
        'BN',
        'BO',
        'BQ',
        'BR',
        'BS',
        'BT',
        'BV',
        'BW',
        'BY',
        'BZ',
        'CA',
        'CC',
        'CD',
        'CF',
        'CG',
        'CH',
        'CI',
        'CK',
        'CL',
        'CM',
        'CN',
        'CO',
        'CR',
        'CU',
        'CV',
        'CW',
        'CX',
        'CY',
        'CZ',
        'DE',
        'DJ',
        'DK',
        'DM',
        'DO',
        'DZ',
        'EC',
        'EE',
        'EG',
        'EH',
        'ER',
        'ES',
        'ET',
        'FI',
        'FJ',
        'FK',
        'FM',
        'FO',
        'FR',
        'GA',
        'GB',
        'GD',
        'GE',
        'GF',
        'GG',
        'GH',
        'GI',
        'GL',
        'GM',
        'GN',
        'GP',
        'GQ',
        'GR',
        'GS',
        'GT',
        'GU',
        'GW',
        'GY',
        'HK',
        'HM',
        'HN',
        'HR',
        'HT',
        'HU',
        'ID',
        'IE',
        'IL',
        'IM',
        'IN',
        'IO',
        'IQ',
        'IR',
        'IS',
        'IT',
        'JE',
        'JM',
        'JO',
        'JP',
        'KE',
        'KG',
        'KH',
        'KI',
        'KM',
        'KN',
        'KP',
        'KR',
        'KW',
        'KY',
        'KZ',
        'LA',
        'LB',
        'LC',
        'LI',
        'LK',
        'LR',
        'LS',
        'LT',
        'LU',
        'LV',
        'LY',
        'MA',
        'MC',
        'MD',
        'ME',
        'MF',
        'MG',
        'MH',
        'MK',
        'ML',
        'MM',
        'MN',
        'MO',
        'MP',
        'MQ',
        'MR',
        'MS',
        'MT',
        'MU',
        'MV',
        'MW',
        'MX',
        'MY',
        'MZ',
        'NA',
        'NC',
        'NE',
        'NF',
        'NG',
        'NI',
        'NL',
        'NO',
        'NP',
        'NR',
        'NU',
        'NZ',
        'OM',
        'PA',
        'PE',
        'PF',
        'PG',
        'PH',
        'PK',
        'PL',
        'PM',
        'PN',
        'PR',
        'PS',
        'PT',
        'PW',
        'PY',
        'QA',
        'RE',
        'RO',
        'RS',
        'RU',
        'RW',
        'SA',
        'SB',
        'SC',
        'SD',
        'SE',
        'SG',
        'SH',
        'SI',
        'SJ',
        'SK',
        'SL',
        'SM',
        'SN',
        'SO',
        'SR',
        'SS',
        'ST',
        'SV',
        'SX',
        'SY',
        'SZ',
        'TC',
        'TD',
        'TF',
        'TG',
        'TH',
        'TJ',
        'TK',
        'TL',
        'TM',
        'TN',
        'TO',
        'TR',
        'TT',
        'TV',
        'TW',
        'TZ',
        'UA',
        'UG',
        'UM',
        'US',
        'UY',
        'UZ',
        'VA',
        'VC',
        'VE',
        'VG',
        'VI',
        'VN',
        'VU',
        'WF',
        'WS',
        'YE',
        'YT',
        'ZA',
        'ZM',
        'ZW',
        //ISO 3166-1 ALPHA 3
        'ABW',
        'AFG',
        'AGO',
        'AIA',
        'ALA',
        'ALB',
        'AND',
        'ARE',
        'ARG',
        'ARM',
        'ASM',
        'ATA',
        'ATF',
        'ATG',
        'AUS',
        'AUT',
        'AZE',
        'BDI',
        'BEL',
        'BEN',
        'BES',
        'BFA',
        'BGD',
        'BGR',
        'BHR',
        'BHS',
        'BIH',
        'BLM',
        'BLR',
        'BLZ',
        'BMU',
        'BOL',
        'BRA',
        'BRB',
        'BRN',
        'BTN',
        'BVT',
        'BWA',
        'CAF',
        'CAN',
        'CCK',
        'CHE',
        'CHL',
        'CHN',
        'CIV',
        'CMR',
        'COD',
        'COG',
        'COK',
        'COL',
        'COM',
        'CPV',
        'CRI',
        'CUB',
        'CUW',
        'CXR',
        'CYM',
        'CYP',
        'CZE',
        'DEU',
        'DJI',
        'DMA',
        'DNK',
        'DOM',
        'DZA',
        'ECU',
        'EGY',
        'ERI',
        'ESH',
        'ESP',
        'EST',
        'ETH',
        'FIN',
        'FJI',
        'FLK',
        'FRA',
        'FRO',
        'FSM',
        'GAB',
        'GBR',
        'GEO',
        'GGY',
        'GHA',
        'GIB',
        'GIN',
        'GLP',
        'GMB',
        'GNB',
        'GNQ',
        'GRC',
        'GRD',
        'GRL',
        'GTM',
        'GUF',
        'GUM',
        'GUY',
        'HKG',
        'HMD',
        'HND',
        'HRV',
        'HTI',
        'HUN',
        'IDN',
        'IMN',
        'IND',
        'IOT',
        'IRL',
        'IRN',
        'IRQ',
        'ISL',
        'ISR',
        'ITA',
        'JAM',
        'JEY',
        'JOR',
        'JPN',
        'KAZ',
        'KEN',
        'KGZ',
        'KHM',
        'KIR',
        'KNA',
        'KOR',
        'KWT',
        'LAO',
        'LBN',
        'LBR',
        'LBY',
        'LCA',
        'LIE',
        'LKA',
        'LSO',
        'LTU',
        'LUX',
        'LVA',
        'MAC',
        'MAF',
        'MAR',
        'MCO',
        'MDA',
        'MDG',
        'MDV',
        'MEX',
        'MHL',
        'MKD',
        'MLI',
        'MLT',
        'MMR',
        'MNE',
        'MNG',
        'MNP',
        'MOZ',
        'MRT',
        'MSR',
        'MTQ',
        'MUS',
        'MWI',
        'MYS',
        'MYT',
        'NAM',
        'NCL',
        'NER',
        'NFK',
        'NGA',
        'NIC',
        'NIU',
        'NLD',
        'NOR',
        'NPL',
        'NRU',
        'NZL',
        'OMN',
        'PAK',
        'PAN',
        'PCN',
        'PER',
        'PHL',
        'PLW',
        'PNG',
        'POL',
        'PRI',
        'PRK',
        'PRT',
        'PRY',
        'PSE',
        'PYF',
        'QAT',
        'REU',
        'ROU',
        'RUS',
        'RWA',
        'SAU',
        'SDN',
        'SEN',
        'SGP',
        'SGS',
        'SHN',
        'SJM',
        'SLB',
        'SLE',
        'SLV',
        'SMR',
        'SOM',
        'SPM',
        'SRB',
        'SSD',
        'STP',
        'SUR',
        'SVK',
        'SVN',
        'SWE',
        'SWZ',
        'SXM',
        'SYC',
        'SYR',
        'TCA',
        'TCD',
        'TGO',
        'THA',
        'TJK',
        'TKL',
        'TKM',
        'TLS',
        'TON',
        'TTO',
        'TUN',
        'TUR',
        'TUV',
        'TWN',
        'TZA',
        'UGA',
        'UKR',
        'UMI',
        'URY',
        'USA',
        'UZB',
        'VAT',
        'VCT',
        'VEN',
        'VGB',
        'VIR',
        'VNM',
        'VUT',
        'WLF',
        'WSM',
        'YEM',
        'ZAF',
        'ZMB',
        'ZWE',
    );

    /**
     * @var array
     */
    protected $iso4217 = array(
        'AFN',
        'EUR',
        'ALL',
        'DZD',
        'USD',
        'EUR',
        'AOA',
        'XCD',
        'XCD',
        'ARS',
        'AMD',
        'AWG',
        'AUD',
        'EUR',
        'AZN',
        'BSD',
        'BHD',
        'BDT',
        'BBD',
        'BYR',
        'EUR',
        'BZD',
        'XOF',
        'BMD',
        'BTN',
        'INR',
        'BOB',
        'BOV',
        'USD',
        'BAM',
        'BWP',
        'NOK',
        'BRL',
        'USD',
        'BND',
        'BGN',
        'XOF',
        'BIF',
        'KHR',
        'XAF',
        'CAD',
        'CVE',
        'KYD',
        'XAF',
        'XAF',
        'CLF',
        'CLP',
        'CNY',
        'AUD',
        'AUD',
        'COP',
        'COU',
        'KMF',
        'XAF',
        'CDF',
        'NZD',
        'CRC',
        'XOF',
        'HRK',
        'CUC',
        'CUP',
        'ANG',
        'EUR',
        'CZK',
        'DKK',
        'DJF',
        'XCD',
        'DOP',
        'USD',
        'EGP',
        'SVC',
        'USD',
        'XAF',
        'ERN',
        'EUR',
        'ETB',
        'EUR',
        'FKP',
        'DKK',
        'FJD',
        'EUR',
        'EUR',
        'EUR',
        'XPF',
        'EUR',
        'XAF',
        'GMD',
        'GEL',
        'EUR',
        'GHS',
        'GIP',
        'EUR',
        'DKK',
        'XCD',
        'EUR',
        'USD',
        'GTQ',
        'GBP',
        'GNF',
        'XOF',
        'GYD',
        'HTG',
        'USD',
        'AUD',
        'EUR',
        'HNL',
        'HKD',
        'HUF',
        'ISK',
        'INR',
        'IDR',
        'XDR',
        'IRR',
        'IQD',
        'EUR',
        'GBP',
        'ILS',
        'EUR',
        'JMD',
        'JPY',
        'GBP',
        'JOD',
        'KZT',
        'KES',
        'AUD',
        'KPW',
        'KRW',
        'KWD',
        'KGS',
        'LAK',
        'EUR',
        'LBP',
        'LSL',
        'ZAR',
        'LRD',
        'LYD',
        'CHF',
        'LTL',
        'EUR',
        'MOP',
        'MKD',
        'MGA',
        'MWK',
        'MYR',
        'MVR',
        'XOF',
        'EUR',
        'USD',
        'EUR',
        'MRO',
        'MUR',
        'EUR',
        'XUA',
        'MXN',
        'MXV',
        'USD',
        'MDL',
        'EUR',
        'MNT',
        'EUR',
        'XCD',
        'MAD',
        'MZN',
        'MMK',
        'NAD',
        'ZAR',
        'AUD',
        'NPR',
        'EUR',
        'XPF',
        'NZD',
        'NIO',
        'XOF',
        'NGN',
        'NZD',
        'AUD',
        'USD',
        'NOK',
        'OMR',
        'PKR',
        'USD',
        'PAB',
        'USD',
        'PGK',
        'PYG',
        'PEN',
        'PHP',
        'NZD',
        'PLN',
        'EUR',
        'USD',
        'QAR',
        'EUR',
        'RON',
        'RUB',
        'RWF',
        'EUR',
        'SHP',
        'XCD',
        'XCD',
        'EUR',
        'EUR',
        'XCD',
        'WST',
        'EUR',
        'STD',
        'SAR',
        'XOF',
        'RSD',
        'SCR',
        'SLL',
        'SGD',
        'ANG',
        'XSU',
        'EUR',
        'EUR',
        'SBD',
        'SOS',
        'ZAR',
        'SSP',
        'EUR',
        'LKR',
        'SDG',
        'SRD',
        'NOK',
        'SZL',
        'SEK',
        'CHE',
        'CHF',
        'CHW',
        'SYP',
        'TWD',
        'TJS',
        'TZS',
        'THB',
        'USD',
        'XOF',
        'NZD',
        'TOP',
        'TTD',
        'TND',
        'TRY',
        'TMT',
        'USD',
        'AUD',
        'UGX',
        'UAH',
        'AED',
        'GBP',
        'USD',
        'USN',
        'USS',
        'USD',
        'UYI',
        'UYU',
        'UZS',
        'VUV',
        'EUR',
        'VEF',
        'VND',
        'USD',
        'USD',
        'XPF',
        'MAD',
        'YER',
        'ZMW',
        'ZWL',
        'XBA',
        'XBB',
        'XBC',
        'XBD',
        'XTS',
        'XXX',
        'XAU',
        'XPD',
        'XPT',
        'XAG',
    );

    /**
     * @param $value
     *
     * @return bool|string
     */
    public function validateAllowEmbed($value)
    {
        return $this->validateYesNo($value);
    }

    /**
     * @param $value
     *
     * @return bool|string
     */
    protected function validateYesNo($value)
    {
        switch (strtolower($value)) {
            case 'yes':
                return 'yes';
                break;
            case 'no':
                return 'no';
                break;
        }

        return false;
    }

    /**
     * @param $string
     *
     * @return bool|string
     */
    public function validateAutoplay($string)
    {
        if (!empty($string)) {
            return $string;
        }

        return false;
    }

    /**
     * @param $loc
     *
     * @return bool|string
     */
    public function validateThumbnailLoc($loc)
    {
        return $this->validateLoc($loc);
    }

    /**
     * @param $title
     *
     * @return bool|string
     */
    public function validateTitle($title)
    {
        if (mb_strlen($title, 'UTF-8') > 97) {
            return mb_substr($title, 0, 97, 'UTF-8').'...';
        }

        return false;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     *
     * @return bool|string
     */
    public function validateDescription($description)
    {
        if (mb_strlen($description, 'UTF-8') > 2048) {
            return mb_substr($description, 0, 2045, 'UTF-8').'...';
        }

        return false;
    }

    /**
     * @param $contentLoc
     *
     * @return bool|string
     */
    public function validateContentLoc($contentLoc)
    {
        return $this->validateLoc($contentLoc);
    }

    /**
     * @param $playerLoc
     *
     * @return bool|string
     */
    public function validatePlayerLoc($playerLoc)
    {
        return $this->validateLoc($playerLoc);
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
        if ($seconds <= 28800 && $seconds >= 0) {
            return $seconds;
        }

        return false;
    }

    /**
     * @param $expirationDate
     *
     * @return bool|string
     */
    public function validateExpirationDate($expirationDate)
    {
        return $this->validateDate($expirationDate);
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     *
     * @return bool|string
     */
    public function validateRating($rating)
    {
        if (is_numeric($rating) && $rating > -0.01 && $rating < 5.01) {
            preg_match('/([0-9].[0-9])/', $rating, $matches);
            $matches[0] = floatval($matches[0]);

            if (!empty($matches[0]) && $matches[0] <= 5.0 && $matches[0] >= 0.0) {
                return $matches[0];
            }
        }

        return false;
    }

    /**
     * @param $viewCount
     *
     * @return bool|string
     */
    public function validateViewCount($viewCount)
    {
        if (is_integer($viewCount) && $viewCount > 0) {
            return $viewCount;
        }

        return false;
    }

    /**
     * @param $publicationDate
     *
     * @return bool|string
     */
    public function validatePublicationDate($publicationDate)
    {
        return $this->validateDate($publicationDate);
    }

    /**
     * @param $familyFriendly
     *
     * @return bool|string
     */
    public function validateFamilyFriendly($familyFriendly)
    {
        if (strtolower($familyFriendly) == 'no') {
            return 'No';
        } elseif (strtolower($familyFriendly) == 'yes') {
            return 'Yes';
        }

        return false;
    }

    /**
     * @param $countries
     *
     * @return bool|string
     */
    public function validateRestriction($countries)
    {
        $valid = array();

        //If data is not passed as an array, do so.
        if (!is_array($countries)) {
            $countries = explode(' ', $countries);
            $countries = array_filter($countries);
        }

        //Foreach value, check if it is a valid $this->iso3166 value
        foreach ($countries as $country) {
            $country = preg_replace('/[^a-z]/i', '', $country);
            $country = strtoupper($country);
            if (in_array($country, $this->iso3166, true)) {
                $valid[] = $country;
            }
        }

        $data = implode(' ', $valid);

        return (strlen($data) > 0) ? $data : false;
    }

    /**
     * @param $restrictionRelationship
     *
     * @return bool|string
     */
    public function validateRestrictionRelationship($restrictionRelationship)
    {
        return $this->validateAllowDeny($restrictionRelationship);
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship" specifies whether the video is restricted or permitted.
     * Allowed values are allow or deny.
     *
     * @param $access
     *
     * @return bool|string
     */
    protected function validateAllowDeny($access)
    {
        switch (strtolower($access)) {
            case 'allow':
                return 'allow';
                break;
            case 'deny':
                return 'deny';
                break;
        }

        return false;
    }

    /**
     * @param $galleryLoc
     *
     * @return bool|string
     */
    public function validateGalleryLoc($galleryLoc)
    {
        return $this->validateLoc($galleryLoc);
    }

    /**
     * @param $title
     *
     * @return bool|string
     */
    public function validateGalleryLocTitle($title)
    {
        if (is_string($title) && strlen($title) > 0) {
            return $title;
        }

        return false;
    }

    /**
     * @param $requiresSubscription
     *
     * @return bool|string
     */
    public function validateRequiresSubscription($requiresSubscription)
    {
        return $this->validateYesNo($requiresSubscription);
    }

    /**
     * @param $uploader
     *
     * @return bool|mixed
     */
    public function validateUploader($uploader)
    {
        if (is_string($uploader) && strlen($uploader) > 0) {
            return $uploader;
        }

        return false;
    }

    /**
     * @param $uploaderLoc
     *
     * @return bool|string
     */
    public function validateUploaderInfo($uploaderLoc)
    {
        return $this->validateLoc($uploaderLoc);
    }

    /**
     * @param $platform
     *
     * @return bool|string
     */
    public function validatePlatform($platform)
    {
        $platforms = explode(" ", $platform);
        array_filter($platforms);

        foreach ($platforms as $key => $platform) {
            if (strtolower($platform) != 'tv' && strtolower($platform) != 'mobile' && strtolower($platform) != 'web') {
                unset($platforms[$key]);
            }
        }

        $data = implode(' ', $platforms);

        return (strlen($data) > 0) ? $data : false;
    }

    /**
     * @param $platform_access
     *
     * @return bool|string
     */
    public function validatePlatformRelationship($platform_access)
    {
        return $this->validateAllowDeny($platform_access);
    }

    /**
     * @param $live
     *
     * @return bool|string
     */
    public function validateLive($live)
    {
        return $this->validateYesNo($live);
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
        if (is_array($tags)) {
            if (count($tags) > $this->maxVideoTagTags) {
                return array_slice($tags, 0, 32);
            }

            return $tags;
        }

        if (is_string($tags)) {
            return array($tags);
        }

        return false;
    }

    /**
     * @param array $prices
     *
     * @return bool|array
     */
    public function validatePrice(array $prices)
    {
        $valid = array();

        if (
            !empty($prices['price'])
            && !empty($prices['price_currency'])
            && (filter_var($prices['price'], FILTER_VALIDATE_FLOAT) || filter_var(
                    $prices['price'],
                    FILTER_VALIDATE_INT
                ))
            && array_search(strtoupper($prices['price_currency']), array_unique($this->iso4217), true)
        ) {
            $prices['price_currency'] = strtoupper($prices['price_currency']);

            if (!empty($prices['resolution'])) {
                $prices['resolution'] = $this->validatePriceResolution($prices['resolution']);
            }

            if (!empty($prices['type'])) {
                $prices['type'] = $this->validatePriceType($prices['type']);
            }

            $valid = array_filter($prices);
        }

        return (count($valid) > 0) ? $valid : false;
    }

    /**
     * @param string $resolution
     *
     * @return bool|string
     */
    protected function validatePriceResolution($resolution)
    {
        switch (strtoupper($resolution)) {
            case 'HD':
                return 'HD';
                break;
            case 'SD':
                return 'SD';
                break;
        }

        return false;
    }

    /**
     * @param string $type
     *
     * @return bool|string
     */
    protected function validatePriceType($type)
    {
        switch (strtolower($type)) {
            case 'own':
                return 'own';
                break;
            case 'rent':
                return 'rent';
                break;
        }

        return false;
    }
}

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
     * @return string
     */
    public function validateAllowEmbed($value)
    {
        return $this->validateYesNo($value);
    }

    /**
     * @param $value
     * @return string
     */
    protected function validateYesNo($value)
    {
        $data = '';
        switch (strtolower($value)) {
            case 'yes':
                $data = 'yes';
                break;
            case 'no':
                $data = 'no';
                break;
        }

        return $data;
    }

    /**
     * @param $string
     * @return string
     */
    public function validateAutoplay($string)
    {
        $data = '';
        if (!empty($string)) {
            $data = $string;
        }

        return $data;
    }

    /**
     * @param $loc
     * @return string
     */
    public function validateThumbnailLoc($loc)
    {
        return $this->validateLoc($loc);
    }

    /**
     * @param $title
     * @return string
     */
    public function validateTitle($title)
    {
        if (mb_strlen($title, 'UTF-8') > 97) {
            $title = mb_substr($title, 0, 97, 'UTF-8').'...';
        }

        return $title;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     * @return string
     */
    public function validateDescription($description)
    {
        if (mb_strlen($description, 'UTF-8') > 2048) {
            $description = mb_substr($description, 0, 2045, 'UTF-8').'...';
        }

        return $description;
    }

    /**
     * @param $content_loc
     * @return string
     */
    public function validateContentLoc($content_loc)
    {
        return $this->validateLoc($content_loc);
    }

    /**
     * @param $player_loc
     * @return string
     */
    public function validatePlayerLoc($player_loc)
    {
        return $this->validateLoc($player_loc);
    }

    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     * @return string
     */
    public function validateDuration($seconds)
    {
        if ($seconds <= 28800 && $seconds >= 0) {
            return $seconds;
        }

        return '';
    }

    /**
     * @param $expiration_date
     * @return string
     */
    public function validateExpirationDate($expiration_date)
    {
        return $this->validateDate($expiration_date);
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     * @return string
     */
    public function validateRating($rating)
    {
        $data = '';
        if (is_numeric($rating) && $rating > -0.01 && $rating < 5.01) {
            preg_match('/([0-9].[0-9])/', $rating, $matches);
            $matches[0] = floatval($matches[0]);

            if (!empty($matches[0]) && $matches[0] <= 5.0 && $matches[0] >= 0.0) {
                $data = $matches[0];
            }
        }

        return $data;
    }

    /**
     * @param $view_count
     * @return string
     */
    public function validateViewCount($view_count)
    {
        $data = '';
        if (is_integer($view_count) && $view_count > 0) {
            $data = $view_count;
        }

        return $data;
    }

    /**
     * @param $publication_date
     * @return string
     */
    public function validatePublicationDate($publication_date)
    {
        return $this->validateDate($publication_date);
    }

    /**
     * @param $family_friendly
     * @return string
     */
    public function validateFamilyFriendly($family_friendly)
    {
        $data = '';
        if (ucfirst(strtolower($family_friendly)) == 'No') {
            $data = 'No';
        } elseif (ucfirst(strtolower($family_friendly)) == 'Yes') {
            $data = 'Yes';
        }

        return $data;
    }

    /**
     * @param $countries
     * @return string
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

        return implode(" ", $valid);
    }

    /**
     * @param $restriction_relationship
     * @return string
     */
    public function validateRestrictionRelationship($restriction_relationship)
    {
        return $this->validateAllowDeny($restriction_relationship);
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship" specifies whether the video is restricted or permitted.
     * Allowed values are allow or deny.
     *
     * @param $access
     * @return string
     */
    protected function validateAllowDeny($access)
    {
        $data = '';
        switch (strtolower($access)) {
            case 'allow':
                $data = 'allow';
                break;
            case 'deny':
                $data = 'deny';
                break;
        }

        return $data;
    }

    /**
     * @param $gallery_loc
     * @return string
     */
    public function validateGalleryLoc($gallery_loc)
    {
        return $this->validateLoc($gallery_loc);
    }

    /**
     * @param $title
     * @return string
     */
    public function validateGalleryLocTitle($title)
    {
        return $title;
    }

    /**
     * @param $requires_subscription
     * @return string
     */
    public function validateRequiresSubscription($requires_subscription)
    {
        return $this->validateYesNo($requires_subscription);
    }

    /**
     * @param $uploader
     * @return mixed
     */
    public function validateUploader($uploader)
    {
        return $uploader;
    }

    /**
     * @param $uploader_loc
     * @return string
     */
    public function validateUploaderInfo($uploader_loc)
    {
        return $this->validateLoc($uploader_loc);
    }

    /**
     * @param $platform
     * @return string
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

        return implode(' ', $platforms);
    }

    /**
     * @param $platform_access
     * @return string
     */
    public function validatePlatformRelationship($platform_access)
    {
        return $this->validateAllowDeny($platform_access);
    }

    /**
     * @param $live
     * @return string
     */
    public function validateLive($live)
    {
        return $this->validateYesNo($live);
    }

    /**
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     * @return array
     */
    public function validateTag($tags)
    {
        $data = array();

        if (is_array($tags)) {
            if (count($tags) > $this->maxVideoTagTags) {
                $data = array_slice($tags, 0, 32);
            } else {
                $data = $tags;
            }
        } elseif (is_string($tags)) {
            $data = array($tags);
        }

        return $data;
    }

    /**
     * @param  array $prices
     * @return array
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

        return $valid;
    }

    /**
     * @param  string $resolution
     * @return string
     */
    protected function validatePriceResolution($resolution)
    {
        $data = '';
        switch (strtoupper($resolution)) {
            case 'HD':
                $data = 'HD';
                break;
            case 'SD':
                $data = 'SD';
                break;
        }

        return $data;
    }

    /**
     * @param  string $type
     * @return string
     */
    protected function validatePriceType($type)
    {
        $data = '';
        switch (strtolower($type)) {
            case 'own':
                $data = 'own';
                break;
            case 'rent':
                $data = 'rent';
                break;
        }

        return $data;
    }
}

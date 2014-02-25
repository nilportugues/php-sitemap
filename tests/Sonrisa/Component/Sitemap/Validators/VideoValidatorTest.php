<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\VideoValidator;

/**
 * Class VideoValidatorTest
 * @package Validators
 */
class VideoValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\VideoValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new VideoValidator();
    }

    public function testValidateAllowEmbedValid1()
    {
        $result = $this->validator->validateAllowEmbed('yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateAllowEmbed('Yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateAllowEmbed('yEs');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateAllowEmbed('YES');
        $this->assertEquals('yes',$result);
    }

    public function testValidateAllowEmbedValid2()
    {
        $result = $this->validator->validateAllowEmbed('no');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateAllowEmbed('No');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateAllowEmbed('NO');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateAllowEmbed('nO');
        $this->assertEquals('no',$result);
    }

    public function testValidateAllowEmbedInvalid()
    {
        $result = $this->validator->validateAllowEmbed('nasdasdasdo');
        $this->assertEquals('',$result);
    }

    public function testValidateAutoplay()
    {
        $result = $this->validator->validateAutoplay('ap=1');
        $this->assertEquals('ap=1',$result);
    }

    public function testValidateAutoplayEmptyString()
    {
        $result = $this->validator->validateAutoplay('');
        $this->assertEquals('',$result);
    }


    public function testValidateThumbnailLocValid()
    {
        $result = $this->validator->validateThumbnailLoc('http://google.com/thumb.jpg');
        $this->assertEquals('http://google.com/thumb.jpg',$result);
    }

    public function testValidateThumbnailLocInvalid()
    {
        $result = $this->validator->validateThumbnailLoc('not-a-url');
        $this->assertEquals('',$result);
    }

    public function testValidateTitleValid()
    {
        $title = 'short title';
        $expected = $title;

        $result = $this->validator->validateTitle($title);

        $this->assertEquals($expected,$result);
    }

    public function testValidateTitleLong()
    {
        $title = 'sdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfdsfdjksfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfdsfdjksfdjk';
        $expected = mb_substr($title, 0, 97, 'UTF-8').'...';
        $result = $this->validator->validateTitle($title);

        $this->assertEquals($expected,$result);
    }

    public function testValidateDescriptionValid()
    {
        $description = 'short description';
        $expected = $description;

        $result = $this->validator->validateDescription($description);

        $this->assertEquals($expected,$result);
    }

    public function testValidateDescriptionLong()
    {
        $description =  'sdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfdsfdjk'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd'.
                        'sfdjksdfsdfksdfjkdfsjksdfjksdfjksdfjsfjksdsfjkdsfdjksdfsfdjksdfsdfkjsdfjksdfjksdfsdfjksfd';

        $expected = mb_substr($description, 0, 2045, 'UTF-8').'...';
        $result = $this->validator->validateDescription($description);

        $this->assertEquals($expected,$result);
    }


    public function testValidateContentLocValid()
    {
        $result = $this->validator->validateContentLoc('http://google.com/video');
        $this->assertEquals('http://google.com/video',$result);
    }

    public function testValidateContentLocInvalid()
    {
        $result = $this->validator->validateContentLoc('not-a-url');
        $this->assertEquals('',$result);
    }

    public function testValidatePlayerLocValid()
    {
        $result = $this->validator->validatePlayerLoc('http://google.com/player.swf');
        $this->assertEquals('http://google.com/player.swf',$result);
    }

    public function testValidatePlayerLocInvalid()
    {
        $result = $this->validator->validatePlayerLoc('not-a-url');
        $this->assertEquals('',$result);
    }

    public function testValidateExpirationDateValidFormat1()
    {
        $date = new \DateTime('now');
        $date = $date->format('c');
        $result = $this->validator->validateExpirationDate($date);

        $this->assertEquals($date,$result);

    }

    public function testValidateExpirationDateValidFormat2()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validator->validateExpirationDate($date);

        $this->assertEquals($date,$result);

    }

    public function testValidateExpirationDateValidFormat3()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d');

        $result = $this->validator->validateExpirationDate($date);

        $this->assertEquals($date,$result);
    }

    public function testValidateExpirationDateInvalidFormat()
    {
        $date = '2A-13-03';

        $result = $this->validator->validateExpirationDate($date);

        $this->assertEquals('',$result);
    }


    public function testValidateDurationValid1()
    {
        $result = $this->validator->validateDuration(10000);
        $this->assertEquals(10000,$result);
    }

    public function testValidateDurationValid2()
    {
        $result = $this->validator->validateDuration(10);
        $this->assertEquals(10,$result);
    }

    public function testValidateDurationInvalid1()
    {
        $result = $this->validator->validateDuration(3000000000);
        $this->assertEquals('',$result);
    }

    public function testValidateDurationInvalid2()
    {
        $result = $this->validator->validateDuration(-1);
        $this->assertEquals('',$result);
    }


    public function testValidateRatingValid1()
    {
        $result = $this->validator->validateRating(0.1);
        $this->assertEquals(0.1,$result);
    }

    public function testValidateRatingValid2()
    {
        $result = $this->validator->validateRating(4.9);
        $this->assertEquals(4.9,$result);
    }

    public function testValidateRatingInvalid1()
    {
        $result = $this->validator->validateRating(7.5);
        $this->assertEquals('',$result);
    }

    public function testValidateRatingInvalid2()
    {
        $result = $this->validator->validateRating(-0.1);
        $this->assertEquals('',$result);
    }


    public function testValidateViewCountValid()
    {
        $result = $this->validator->validateViewCount(100);
        $this->assertEquals(100,$result);
    }

    public function testValidateViewCountInvalid1()
    {
        $result = $this->validator->validateViewCount(-100);
        $this->assertEquals('',$result);
    }

    public function testValidateViewCountInvalid2()
    {
        $result = $this->validator->validateViewCount("A");
        $this->assertEquals('',$result);
    }

    public function testValidateViewCountInvalid3()
    {
        $result = $this->validator->validateViewCount(3.14);
        $this->assertEquals('',$result);
    }


    public function testValidateFamilyFriendlyValid1()
    {
        $result = $this->validator->validateFamilyFriendly('No');
        $this->assertEquals('No',$result);
    }

    public function testValidateFamilyFriendlyValid2()
    {
        $result = $this->validator->validateFamilyFriendly('NO');
        $this->assertEquals('No',$result);
    }

    public function testValidateFamilyFriendlyValid3()
    {
        $result = $this->validator->validateFamilyFriendly('nO');
        $this->assertEquals('No',$result);
    }

    public function testValidateFamilyFriendlyValid4()
    {
        $result = $this->validator->validateFamilyFriendly('no');
        $this->assertEquals('No',$result);
    }


    public function testValidateFamilyFriendlyInvalid1()
    {
        $result = $this->validator->validateFamilyFriendly('Yes');
        $this->assertEquals('',$result);
    }

    public function testValidateFamilyFriendlyInvalid2()
    {
        $result = $this->validator->validateFamilyFriendly('AAAA');
        $this->assertEquals('',$result);
    }

    public function testValidatePublicationDateValidFormat1()
    {
        $date = new \DateTime('now');
        $date = $date->format('c');
        $result = $this->validator->validatePublicationDate($date);

        $this->assertEquals($date,$result);

    }

    public function testValidatePublicationDateValidFormat2()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validator->validatePublicationDate($date);

        $this->assertEquals($date,$result);

    }

    public function testValidatePublicationDateValidFormat3()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d');

        $result = $this->validator->validatePublicationDate($date);

        $this->assertEquals($date,$result);
    }

    public function testValidatePublicationDateInvalidFormat()
    {
        $date = '2A-13-03';

        $result = $this->validator->validatePublicationDate($date);

        $this->assertEquals('',$result);
    }

    public function testValidateRestrictionValid1()
    {
        $result = $this->validator->validateRestriction('ABW AFG AGO');
        $this->assertEquals('ABW AFG AGO',$result);
    }

    public function testValidateRestrictionValid2()
    {
        $result = $this->validator->validateRestriction(array('ABW','AFG','AGO'));
        $this->assertEquals('ABW AFG AGO',$result);
    }

    public function testValidateRestrictionValid3()
    {
        $result = $this->validator->validateRestriction(array('NOT-VALID','AFG','AGO'));
        $this->assertEquals('AFG AGO',$result);
    }


    public function testValidateGalleryLocValid()
    {
        $result = $this->validator->validateGalleryLoc('http://google.com/gallery');
        $this->assertEquals('http://google.com/gallery',$result);
    }

    public function testValidateGalleryLocInvalid()
    {
        $result = $this->validator->validateGalleryLoc('not-a-url');
        $this->assertEquals('',$result);
    }

    public function testValidateGalleryLocTitleValid()
    {
        $result = $this->validator->validateGalleryLocTitle('Some title');
        $this->assertEquals('Some title',$result);
    }

    public function testValidateGalleryLocTitleEmpty()
    {
        $result = $this->validator->validateGalleryLocTitle('');
        $this->assertEquals('',$result);
    }


    public function testValidateRequiresSubscriptionValid1()
    {
        $result = $this->validator->validateRequiresSubscription('yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateRequiresSubscription('Yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateRequiresSubscription('yEs');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateRequiresSubscription('YES');
        $this->assertEquals('yes',$result);
    }

    public function testValidateRequiresSubscriptionValid2()
    {
        $result = $this->validator->validateRequiresSubscription('no');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateRequiresSubscription('No');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateRequiresSubscription('NO');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateRequiresSubscription('nO');
        $this->assertEquals('no',$result);
    }

    public function testValidateLiveValid1()
    {
        $result = $this->validator->validateLive('yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateLive('Yes');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateLive('yEs');
        $this->assertEquals('yes',$result);

        $result = $this->validator->validateLive('YES');
        $this->assertEquals('yes',$result);
    }

    public function testValidateLiveValid2()
    {
        $result = $this->validator->validateLive('no');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateLive('No');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateLive('NO');
        $this->assertEquals('no',$result);

        $result = $this->validator->validateLive('nO');
        $this->assertEquals('no',$result);
    }

    public function testValidatePrice()
    {
        $prices = array(
            array
            (
                'price'             => '0.99',
                'price_currency'    => 'EUR',
                'resolution'        => 'HD',
                'type'              => 'rent',
            ),
            array
            (
                'price'             => '3.99',
                'price_currency'    => 'EUR',
                'resolution'        => 'HD',
                'type'              => 'own',
            ),
            array
            (
                'price'             => 'A',
                'price_currency'    => 'I AM INVALID',
                'resolution'        => 'SO I AM',
                'type'              => 'ME TOO',
            ),
        );

        $expected = array(
            array
            (
                'price'             => '0.99',
                'price_currency'    => 'EUR',
                'resolution'        => 'HD',
                'type'              => 'rent',
            ),
            array
            (
                'price'             => '3.99',
                'price_currency'    => 'EUR',
                'resolution'        => 'HD',
                'type'              => 'own',
            )
        );
        $result = $this->validator->validatePrice($prices);

        $this->assertEquals($expected,$result);

    }


    public function testValidateRestrictionRelationshipValid1()
    {
        $result = $this->validator->validateRestrictionRelationship('allow');
        $this->assertEquals('allow',$result);
    }

    public function testValidateRestrictionRelationshipValid2()
    {
        $result = $this->validator->validateRestrictionRelationship('deny');
        $this->assertEquals('deny',$result);
    }

    public function testValidateRestrictionRelationshipInvalid()
    {
        $result = $this->validator->validateRestrictionRelationship('AAA');
        $this->assertEquals('',$result);
    }

    public function testValidateUploader()
    {
        $result = $this->validator->validateUploader('AAA');
        $this->assertEquals('AAA',$result);
    }

    public function testValidateUploaderEmpty()
    {
        $result = $this->validator->validateUploader('');
        $this->assertEquals('',$result);
    }

    public function testValidateUploaderInfo()
    {
        $result = $this->validator->validateUploaderInfo('http://google.com');
        $this->assertEquals('http://google.com',$result);
    }

    public function testValidateUploaderInfoInvalid()
    {
        $result = $this->validator->validateUploaderInfo('no-a-valid-url');
        $this->assertEquals('',$result);
    }

    public function testValidatePlatformRelationshipValid1()
    {
        $result = $this->validator->validatePlatformRelationship('allow');
        $this->assertEquals('allow',$result);
    }

    public function testValidatePlatformRelationshipValid2()
    {
        $result = $this->validator->validatePlatformRelationship('deny');
        $this->assertEquals('deny',$result);
    }

    public function testValidatePlatformRelationshipInvalid()
    {
        $result = $this->validator->validatePlatformRelationship('AAA');
        $this->assertEquals('',$result);
    }

    public function testValidatePlatformValid()
    {
        $result = $this->validator->validatePlatform('web tv mobile');
        $this->assertEquals('web tv mobile',$result);
    }

    public function testValidatePlatformInvalid()
    {
        $result = $this->validator->validatePlatform('web tv xxxxx mobile');
        $this->assertEquals('web tv mobile',$result);
    }

    public function testValidateTagLessThan32()
    {
        $result = $this->validator->validateTag( array('one','tag') );
        $this->assertEquals(array('one','tag'),$result);
    }

    public function testValidateTagMoreThan32()
    {
        $expected = array();
        $tags = array();

        for($i=1;$i<=40;$i++)
        {
            if($i<=32)
            {
                $expected[] = "tag $i";
            }
            $tags[] = "tag $i";
        }

        $result = $this->validator->validateTag($tags);
        $this->assertEquals($expected,$result);
    }

    public function testValidateTagJustOneTag()
    {
        $result = $this->validator->validateTag('one tag');
        $this->assertEquals(array('one tag'),$result);
    }
} 
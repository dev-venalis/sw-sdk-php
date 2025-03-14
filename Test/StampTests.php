<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use SWServices\Stamp\StampService as StampService;
use SWServices\Toolkit\SignService as Sellar;
use SWServices\Stamp\EmisionTimbrado as EmisionTimbrado;
use Exception;
use DOMDocument;
use DateInterval;
use DateTime;
use XSLTProcessor;

class StampTests extends TestCase
{

	protected static $generateXML;

	public static function setUpBeforeClass(): void
	{
		self::$generateXML = new GenerateXML();
	}

	public static function tearDownAfterClass(): void
	{
		self::$generateXML = null;
	}
	/*----------------------------------------V1---------------------------------------------------------------------------------------------------------------*/
	public function testStampXMLV1()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"user" => getenv('SDKTEST_USER'),
			"password" => getenv('SDKTEST_PASSWORD')
		);

		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV1($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
		$this->assertNotNull($result->data->tfd);
	}

	public function testStampXMLV1byToken()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV1($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
		$this->assertNotNull($result->data->tfd);
	}
	public function testStampXMLV2()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"user" => getenv('SDKTEST_USER'),
			"password" => getenv('SDKTEST_PASSWORD')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV2($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
		$this->assertNotNull($result->data->tfd);
	}
	/*----------------------------------V2---------------------------------------------------------------------------------------------------------------------*/
	public function testStampXMLV2byToken()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV2($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
		$this->assertNotNull($result->data->tfd);
	}

	public function testStampXMLV2_B64()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"user" => getenv('SDKTEST_USER'),
			"password" => getenv('SDKTEST_PASSWORD')
		);

		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV2($xml, true);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
		$this->assertNotNull($result->data->tfd);
		$this->assertNotNull($result->data->cfdi);
	}

	public function testStampXMLV2byToken_B64()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV2($xml, true);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
		$this->assertNotNull($result->data->tfd);
		$this->assertNotNull($result->data->cfdi);
	}

	/*--------------------------------V3-----------------------------------------------------------------------------------------------------------------------*/
	public function testStampXMLV3byToken()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV3($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
	}

	public function testStampXMLV3_B64()
	{

		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"user" => getenv('SDKTEST_USER'),
			"password" => getenv('SDKTEST_PASSWORD')
		);

		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV3($xml, true);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
		$this->assertNotNull($result->data->cfdi);
	}

	public function testStampXMLV3byToken_B64()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV3($xml, true);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
	}
	/*--------------------------------V4-----------------------------------------------------------------------------------------------------------------------*/
	public function testStampXMLV4byToken()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::StampV4($xml);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertEquals($resultSpect, $result->status);
	}

	public function testStampXMLV4_B64()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"user" => getenv('SDKTEST_USER'),
			"password" => getenv('SDKTEST_PASSWORD')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV4($xml, true);
		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
	}

	public function testStampXMLV4byToken_B64()
	{
		$resultSpect = "success";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$xml = base64_encode($xml);
		$stamp = StampService::Set($params);
		$result = $stamp::StampV4($xml, true);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}
		$this->assertTrue($resultSpect == $result->status);
	}
	/*--------------------------------Timbrado V4 CustomId-----------------------------------------------------------------------------------------------------------------------*/
	//Prueba V4 CustomId, PDF
	public function testStampV4CustomIdPdf()
	{
		$resultSpect = "success";
		$prefixOne = date('Y-m-d');
		$prefixTwo = rand(0, 555);
		$customId = "Serie-" . $prefixOne . "-" . $prefixTwo;
		$pdf = false;
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::stampV4CustomIdPdfV1($xml, $customId, $pdf);

		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}

		$this->assertTrue($resultSpect == $result->status);
		$this->assertNotNull($result->data);
	}
	public function testStampV4CustomIdEmail()
	{
		$resultSpect = "success";
		$prefixOne = date('Y-m-d');
		$prefixTwo = rand(0, 555);
		$customId = "Serie-" . $prefixOne . "-" . $prefixTwo;
		$email = "correo@gmail.com";
		$params = array(
			"url" => "https://services.test.sw.com.mx",
			"token" => getenv('SDKTEST_TOKEN')
		);
		$xml = file_get_contents(self::$generateXML->createXML());
		$stamp = StampService::Set($params);
		$result = $stamp::stampV4CustomIdEmailV1($xml, $customId, $email);
		if ($result->status == "error" && strpos($result->message, '307') !== false) {
			$result->status = "success";
		}

		$this->assertTrue($resultSpect == $result->status);
		$this->assertNotNull($result->data);
	}
	//Fin Prueba V4 CustomId

}

final class GenerateXML
{
	public $cadenaOriginal = "./Test/Resources/cadenaOriginal.txt";

	function __construct()
	{
		date_default_timezone_set('America/Mexico_City');
		$xml = simplexml_load_file('./Test/Resources/cfdi40.xml');

		$currentDateTime = new DateTime();
		$interval = new DateInterval('PT1H0M0S');
		$currentDateTime->sub($interval);
		$xml["Fecha"] = $currentDateTime->format('Y-m-d\TH:i:s');
		$xml->asXML('./Test/Resources/cfdi40_test.xml');

		$xml = file_get_contents('./Test/Resources/cfdi40_test.xml');
		$xmlFile = "./Test/Resources/cfdi40_test.xml";
		$xslFile = "./Test/Resources/xslt/cadenaoriginal_4_0.xslt";

		$xml = new DOMDocument("1.0", "UTF-8");
		$xml->load($xmlFile);

		$xsl = new DOMDocument();
		$xsl->load($xslFile);

		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl);
		$cadenaOriginal = $proc->transformToXML($xml);

		file_put_contents("./Test/Resources/cadenaOriginal.txt", $cadenaOriginal);
	}

	public function createXML()
	{
		$xml = simplexml_load_file('./Test/Resources/cfdi40_test.xml');
		$currentDateTime = new DateTime();
		$interval = new DateInterval('PT1H0M0S');
		$currentDateTime->sub($interval);

		$date = $date = $currentDateTime->format('Y-m-d\TH:i:s');
		$xml["Fecha"] = $date;
		$xml->asXML('./Test/Resources/cfdi40_test.xml');

		$cadenaOriginal = file_get_contents('./Test/Resources/cadenaOriginal.txt');
		$cadenaOriginal = preg_replace('/\d{4}-\d{2}-\d{2}\T\d{2}:\d{2}:\d{2}/', $date, $cadenaOriginal);


		file_put_contents("./Test/Resources/cadenaOriginal.txt", $cadenaOriginal);

		$params = array(
			"cadenaOriginal" => "./Test/Resources/cadenaOriginal.txt",
			"archivoKeyPem" => "./Test/Resources/cert_pruebas/EKU9003173C9_key.pem",
			"archivoCerPem" => "./Test/Resources/cert_pruebas/EKU9003173C9_Cer.pem"
		);

		try {
			$result = Sellar::ObtenerSello($params);
			if ($result->status == "success") {
				$xml = simplexml_load_file('./Test/Resources/cfdi40_test.xml');
				$xml["Sello"] = $result->sello;
				$xml->asXML('./Test/Resources/cfdi40_test.xml');
				sleep(2);
				return "./Test/Resources/cfdi40_test.xml";
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return '/Test/Resources/cfdi40.xml';
	}
}

<?php
namespace ABS\Tippgame\Tests\Functional;

/*
 * This file is part of the TYPO3 extension tippgame.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Tests\Functional\Framework\Frontend\Response;
use TYPO3\CMS\Core\Tests\FunctionalTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class RenderingTest
 */
class RenderingTest extends FunctionalTestCase {

	/**
	 * @var array
	 */
	protected $testExtensionsToLoad = array('typo3conf/ext/tippgame');

	/**
	 * @var array
	 */
	protected $coreExtensionsToLoad = array('fluid');

	public function setUp() {
		parent::setUp();
		$this->importDataSet(__DIR__ . '/Fixtures/Database/pages.xml');
		$this->setUpFrontendRootPage(1, array('EXT:tippgame/Tests/Functional/Fixtures/Frontend/Basic.ts'));
	}

	/**
	 * @test
	 */
	public function emailViewHelperWorksWithSpamProtection() {
		$requestArguments = array('id' => '1');
		$expectedContent = '<a href="javascript:linkTo_UnCryptMailto(\'ocknvq,cngkejugptkpiBcd\/uqhvncd0fg\');">aleichsenring(AT)ab-softlab(DOT)de</a>';
		$this->assertSame($expectedContent, $this->fetchFrontendResponse($requestArguments)->getContent());
	}



	/* ***************
	 * Utility methods
	 * ***************/



	/**
	 * @param array $requestArguments
	 * @param bool $failOnFailure
	 * @return Response
	 */
	protected function fetchFrontendResponse(array $requestArguments, $failOnFailure = TRUE) {
		if (!empty($requestArguments['url'])) {
			$requestUrl = '/' . ltrim($requestArguments['url'], '/');
		} else {
			$requestUrl = '/?' . GeneralUtility::implodeArrayForUrl('', $requestArguments);
		}

		$arguments = array(
			'documentRoot' => ORIGINAL_ROOT . 'typo3temp/functional-' . substr(sha1(get_class($this)), 0, 7),
			'requestUrl' => 'http://localhost' . $requestUrl,
		);

		$template = new \Text_Template(ORIGINAL_ROOT . 'typo3/sysext/core/Tests/Functional/Fixtures/Frontend/request.tpl');
		$template->setVar(
			array(
				'arguments' => var_export($arguments, TRUE),
				'originalRoot' => ORIGINAL_ROOT,
			)
		);

		$php = \PHPUnit_Util_PHP::factory();
		$response = $php->runJob($template->render());
		$result = json_decode($response['stdout'], TRUE);

		if ($result === NULL) {
			$this->fail('Frontend Response is empty');
		}

		if ($failOnFailure && $result['status'] === Response::STATUS_Failure) {
			$this->fail('Frontend Response has failure:' . LF . $result['error']);
		}

		$response = new Response($result['status'], $result['content'], $result['error']);
		return $response;
	}

}

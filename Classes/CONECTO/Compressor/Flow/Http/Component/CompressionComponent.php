<?php

namespace CONECTO\Compressor\Flow\Http\Component;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Component\ComponentInterface;
use TYPO3\Flow\Http\Component\ComponentContext;


/**
 * Class CompressionComponent
 * @package CONECTO\Compressor\Flow\Http\Component
 * @author Alexander Dick <a.dick@conecto.at>
 */
class CompressionComponent implements ComponentInterface {

	/**
	 * @var array
	 */
	protected $options;

	/**
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		$this->options = $options;
	}

	/**
	 * gzip/deflate the response content
	 * @param ComponentContext $componentContext
	 * @return void
	 */
	public function handle(ComponentContext $componentContext) {
		$response = $componentContext->getHttpResponse();
		$acceptEncoding = $componentContext->getHttpRequest()->getHeader('Accept-Encoding');
		if(strpos($acceptEncoding, 'gzip') !== FALSE) {
			$content = gzencode($response->getContent());
			$response->setHeader('Content-Encoding', 'gzip');
			$response->setContent($content);
		} else if(strpos($acceptEncoding, 'deflate') !== FALSE) {
			$content = gzdeflate($response->getContent());
			$response->setHeader('Content-Encoding', 'deflate');
			$response->setContent($content);
		}
	}
}

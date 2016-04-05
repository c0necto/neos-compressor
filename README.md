# CONECTO Neos Compressor

This package enables gzip/deflate compression for the Neos output.
Additionally, the `head` and `body` section HTML of the `TYPO3.Neos:Page` prototype is being minified using the compressor of `wyrihaximus/html-compress` (borrowed from `flownative/neos-compressor`)

## Installation

`composer require conecto/neos-compressor`

## Usage

Just install it, there are no further steps to take.

### Adjust compression

To disable the HTML minification/compression on `head` and/or `body`, simply override:

```
prototype(TYPO3.Neos:Page) {
	head.@process.compression >
	body.@process.compression >
}
```

To compress specific parts, use the compression helper like this:

```
something.@process.compression = ${CONECTO.Compressor.compress(value)}
```


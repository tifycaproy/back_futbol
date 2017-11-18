<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return Symfony\CS\Config\Config::create()
    ->fixers([
        // some symfony codestyle level checks
        'duplicate_semicolon',
        'extra_empty_lines',
        'function_typehint_space',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_no_access',
        'phpdoc_no_empty_return',
        'phpdoc_no_package',
        'phpdoc_scalar',
        'phpdoc_trim',
        'phpdoc_types',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'self_accessor',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_cast',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',

        // contrib checks
        'newline_after_open_tag',
        'phpdoc_order',
        'short_array_syntax',

    ])
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->setUsingCache(true)
    ->finder($finder);

<?php

/**
 * hana+nils · Büro für Gestaltung
 * https://hananils.de · buero@hananils.de
 */

Kirby::plugin('hananils/bundlekit', [
    'sections' => [
        'customsection' => [
            'props' => [
                'headline' => function ($headline) {
                    return $headline;
                }
            ]
        ]
    ],
    'hooks' => [
        'route:before' => function ($route, $path, $method) {
            $root = __DIR__;
            $source = $root . '/index.vue';
            $compiled = $root . '/index.js';

            if (
                is_file($source) === false ||
                (file_exists($compiled) &&
                    filemtime($source) < filemtime($compiled))
            ) {
                return;
            }

            $contents = file_get_contents($source);

            $template = '';
            if (
                preg_match('/<template>(.*?)<\/template>/s', $contents, $match)
            ) {
                $template = trim($match[1]);
            }

            $script = '';
            if (
                preg_match(
                    '/<script>\s?+export default {(.*?)};\s?+<\/script>/s',
                    $contents,
                    $match
                )
            ) {
                $script = trim($match[1]);
            }

            file_put_contents(
                $compiled,
                "// This file is auto-generated. Please edit index.vue instead.
                panel.plugin('hananils/bundlekit', {
                    sections: {
                        customsection: {
                            $script,
                            template: `$template`
                        }
                    }
                });"
            );
        }
    ]
]);

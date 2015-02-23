"use strict";

require.config({
    baseUrl: "/blackshow/js",
    shim: {
        'jquery': {
            exports: '$'
        },
        'impromptu': {
            deps: ['jquery']
        },
        'bootstrapjs': {
            deps: ['jquery']
        },
        'slider': {
            deps: ['jquery']
        },
        'texteditor': {
            deps: ['jquery']
        },
        'fnsGenerales': {
            deps: ['jquery'],
            exports: 'fnsGenerales'
        }
    },
    paths: {
        'jquery': '../libs/jquery/dist/jquery.min',
        'impromptu': 'libs/jquery-impromptu/dist/jquery-impromptu.min',
        'bootstrapjs': '../libs/bootstrap/dist/js/bootstrap.min',
        'slider': '../libs/9fevrier-responsiveslides/responsiveslides.min',
        'texteditor': '../libs/jqte/jQuery-TE_v.1.3.2/jquery-te-1.3.2.min',
        'fnsGenerales': '../libs/fnsGenerales'
    }
});
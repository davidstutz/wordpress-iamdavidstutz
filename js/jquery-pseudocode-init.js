$(document).ready(function() {
    $('.pseudocode').pseudocode({
        keywords: {
            'if': '#000066',
            'for': '#000066',
            'var': '#000066',
            'function': '#000066',
            'return': '#000066',
            'this': '#000066',
            'while': '#000066',
            'end': '#000066',
            'endif': '#000066',
            'endfor': '#000066',
            'endwhile': '#000066',
            'repeat': '#000066',
            'until': '#000066'
        }
    });
    
    $('#pseudocode-example').pseudocode({
        keywords: {
            'if': '#990000',
            'for': '#990000',
            'var': '#990000'
        },
        comment: {
            '//': '#AAAAAA',
            '%': '#AAAAAA'
        },
        tab: 2
    });
});
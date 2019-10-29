import jQuery from 'jquery';
import Bloodhound from 'bloodhound-js';

(function ($, undefined) {
    const $input = $('input[data-toggle="tagsinput"]');
    if ($input.length) {
        const source = new Bloodhound({
            local: $input.data('tags'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: Bloodhound.tokenizers.whitespace
        });
        source.initialize();

        $input.tagsinput({
            trimValue: true,
            focusClass: 'focus',
            typeaheadjs: {
                name: 'tags',
                source: source.ttAdapter()
            }
        });
    }
})(jQuery);
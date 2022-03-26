import autocomplete from 'autocomplete.js'
import algolia from 'algoliasearch'

var index = algolia('JT69YP5AW6', '79fd39ee468a6f76889712964e59baf2')

export const userautocomplete = (selector) => {
    index = index.initIndex('users')

    return autocomplete(selector, {
        hint: true
    }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
        displayKey: 'name',
        templates: {
            suggestion (suggestion) {
                return '<img src="' + suggestion.avatar + '"> &nbsp; <span>' + suggestion._highlightResult.name.value + '</span><span class="pull-right">' + suggestion.country.name + '</span>'
            },
            empty: '<div class="aa-empty">No people found</div>'
        }
    })
}

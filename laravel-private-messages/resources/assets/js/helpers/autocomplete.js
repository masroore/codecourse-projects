import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

var index = algolia('OE850XKS7P', 'f332dca8ea536a950707b2015a815e94')

export const userautocomplete = selector => {
    var users = index.initIndex('users')

    return autocomplete(selector, {}, {
        source: autocomplete.sources.hits(users, { hitsPerPage: 10 }),
        displayKey: 'name',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion.name + '</span>'
            },
            empty: '<div class="aa-empty">No people found.</div>'
        }
    })
}

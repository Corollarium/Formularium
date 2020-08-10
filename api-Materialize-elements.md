
# Elements for Materialize

List of elements for Materialize and its parameters.

## Badge

Creates a badge field



## Button

Creates a button

### type (string)

Button type. These values are treated: "anchor", "submit", "reset" or "button". Any other value is considered the element name. Default: "button"

### readonly (boolean)

Is it readonly?

### disabled (boolean)

Is it disabled?


## Pagination

Creates a pagination element

### baseURL (string)

Base url for pagination. Default: "?"

### current (int)

Current item. Conflicts with CURRENT_PAGE, use just one of them.

### currentPage (int)

Current page. Conflicts with CURRENT, use just one of them

### pagesAround (int)

Maximum pages show before or after the current one

### perPage (int)

Items per page. Default: 20

### totalItems (int)

Total items found by query.


## Table

Creates a table

### rownames (array)

Is it disabled?

### striped (bool)

Is this table striped?

### bordered (bool)

Is this table bordered?


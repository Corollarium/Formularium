
---
parent: Reference
nav_order: 3
---

# Reference: Elements for Buefy

List of elements for Buefy and its parameters.

## Badge

Creates a badge field



## Button

Creates a button

### label (string)

Label for this button

### type (string)

Button type. These values are treated: "anchor", "submit", "reset" or "button". Any other value is considered the element name. Default: "button"

### readonly (boolean)

Is it readonly?

### disabled (boolean)

Is it disabled?

### color (string)

Button color. Supports HTMLButton::COLOR_PRIMARY, HTMLButton::COLOR_LINK, HTMLButton::COLOR_INFO, HTMLButton::COLOR_SUCCESS, HTMLButton::COLOR_WARNING, HTMLButton::COLOR_ERROR. Default: primary.


## Card

Creates a card

### title (string)

Card title.

### image (string)

Card image.

### link (string)

Card link


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


## Spinner

Creates a spinner



## Table

Creates a table

### rownames (array)

Is it disabled?

### striped (bool)

Is this table striped?

### bordered (bool)

Is this table bordered?


## Upload

Creates an upload field

### label (string)

Label for this upload field

### comment (string)

Comment for this upload field


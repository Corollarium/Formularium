#!/bin/sh

declare -A URLS
URLS[HTMLBootstrapQuill]=HTMLHTMLValidationBootstrapQuill.html
URLS[HTMLBootstrapQuillParsley]=HTMLHTMLValidationBootstrapQuillParsley.html
URLS[HTMLBootstrapReact]=HTMLHTMLValidationBootstrapReact.html
URLS[HTMLBootstrapVue]=HTMLHTMLValidationBootstrapVue.html
URLS[HTMLBuefyVue]=HTMLHTMLValidationBuefyVue.html
URLS[HTMLBulmaQuill]=HTMLHTMLValidationBulmaQuill.html
URLS[HTMLBulmaQuillVue]=HTMLHTMLValidationBulmaQuillVue.html
URLS[HTMLMaterialize]=HTMLHTMLValidationMaterialize.html
URLS[HTMLQuill]=HTMLHTMLValidationQuill.html
URLS[HTMLReact]=HTMLHTMLValidationReact.html

for key in "${!URLS[@]}"
do
    echo "Generating $key.png"
    rm -f docs/shots/$key.png
    google-chrome-stable --headless --screenshot=docs/shots/$key.png file://`pwd`/docs/kitchensink/${URLS[$key]} --window-size=480,740
done
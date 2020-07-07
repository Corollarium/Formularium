#!/bin/sh

declare -A URLS
URLS[HTMLBootstrapQuill]=HTMLBootstrapQuill.html
URLS[HTMLBootstrapQuillParsley]=HTMLBootstrapQuillParsley.html
URLS[HTMLBootstrapReact]=HTMLBootstrapReact.html
URLS[HTMLBootstrapVue]=HTMLBootstrapVue.html
URLS[HTMLBuefyVue]=HTMLBuefyVue.html
URLS[HTMLBulmaQuill]=HTMLBulmaQuill.html
URLS[HTMLBulmaQuillVue]=HTMLBulmaQuillVue.html
URLS[HTMLMaterialize]=HTMLMaterialize.html
URLS[HTMLQuill]=HTMLQuill.html
URLS[HTMLReact]=HTMLReact.html

for key in "${!URLS[@]}"
do
    echo "Generating $key.png"
    rm -f docs/shots/$key.png
    google-chrome-stable --headless --screenshot=docs/shots/$key.png file://`pwd`/docs/kitchensink/${URLS[$key]} --window-size=480,740
done
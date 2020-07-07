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

set -x
for key in "${!URLS[@]}"
do
    echo "Generating $key.png"
    wkhtmltoimage --width 480 --crop-h 740 docs/kitchensink/${URLS[$key]} docs/shots/$key.png
done
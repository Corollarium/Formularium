<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Datatype;
use Formularium\Field;
use Formularium\Frontend\HTML\Framework;
use Formularium\Frontend\HTML\Renderable;
use Formularium\HTMLElement;
use Formularium\Validator\File;

class Renderable_file extends Renderable
{
    use \Formularium\Frontend\HTML\RenderableViewableTrait;

    /**
     * Subcall of wrapper editable() from RenderableMaterializeTrait
     *
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $renderable = $field->getRenderables();
        $validators = $field->getValidators();

        /*
        <fieldset class="loh_fieldset loh_filedata_picker"
        data-acceptedRenderables="<?php echo htmlspecialchars(@$fields['acceptedRenderables']);?>"
        data-basetype="filedata" data-attribute="filedata"
        <?php echo $multipleField; ?>
        >
            <input type="hidden"
                id="loh:filedata_attribute[<?php echo $id; ?>][value]"
                name="loh:filedata_attribute[<?php echo $id; ?>][value]"
                value="<?php echo $fields->getItemMeta('filedata', DataTypeParameter::FILEDATA_ATTRIBUTE);?>"
            />
    <?php
                    if ($fields->getItemMeta('filedata', DataTypeParameter::SHOW_LEGEND)) { ?>
        <legend class="loh_legend
            <?php
                        if ($fields->getItemMeta('filedata', DataTypeParameter::COLLAPSED) === true) {
                            echo 'collapsed';
                        }
                    ?>">
        <?php echo _('File');?></legend>
    <?php
                    }

                    // let's show what we're editing
                    $this->getSmallHTML(new HtmlThingData(PageData::THUMBNAIL_SCALED));

                    ?>
        <section class="loh_section loh_filedata_picker_section" >
        <?php
                    if ($fields->getItemMeta('filedata', DataTypeParameter::COMMENT)) {
                        echo '<span class="loh_explanation">' .
                            htmlspecialchars($fields->getItemMeta('filedata', DataTypeParameter::COMMENT)) .
                            '</span> ';
                    }
                    ?>
        <div class="loh_form_item loh_form_item_header">
            <label class="loh_formlabel"><span class="loh_fieldlabel"><?php echo $label;?></span></label>

            <?php
                $dataRulesRequiredFiledata =
                    ($fields->getItemMeta('filedata', DataTypeParameter::REQUIRED) === true)
                    ? 'data-rules-required-filedata="true"'
                    : '';
            ?>
            <ul class="loh_data_set loh_hide_picked">
            <li class="from-computer">
                <input id="from-computer-input-<?php echo $id;?>" type="radio" value="<?php echo FILEDATA_ORIGIN_UPLOAD;?>"
                       class="loh_filedata_origin_button loh_filedata_origin_upload"
                       name="loh:filedata_origin[<?php echo $id;?>][value]"
                    <?php echo $dataRulesRequiredFiledata ?> checked />
                <label for="from-computer-input-<?php echo $id;?>"><?php echo _('From your device');?></label>
            </li>
            <li class="from-site">
                <input id="from-site-input-<?php echo $id;?>" type="radio" value="<?php echo FILEDATA_ORIGIN_URL;?>"
                    class="loh_filedata_origin_button loh_filedata_origin_url"
                       name="loh:filedata_origin[<?php echo $id;?>][value]"
                    <?php echo $dataRulesRequiredFiledata ?> />
                <label for="from-site-input-<?php echo $id;?>"><?php echo _('From a site');?></label>
            </li>
                    <?php
                    if ($fields->getItemMeta('filedata', static::SHOW_CAMERA) ?? true) {
                    ?>
            <li class="from-camera hasCamera" style="display: none;">
                <input id="from-camera-input-<?php echo $id;?>" type="radio" value="<?php echo FILEDATA_ORIGIN_BASE64;?>"
                    class="loh_filedata_origin_button loh_filedata_origin_base64"
                       name="loh:filedata_origin[<?php echo $id;?>][value]"
                    <?php echo $dataRulesRequiredFiledata ?> />
                <label for="from-camera-input-<?php echo $id;?>"><?php echo _('From camera');?></label>
            </li>
                    <?php
                    }
                    ?>
            </ul>
        </div>*/

        $input = HTMLElement::factory(
            'input',
            [
                'id' => $field->getName() . Framework::counter(),
                'class' => 'formularium-file-upload-button',
                'type' => 'file',
                'data-attribute' => $field->getName(),
                'data-datatype' => $field->getDatatype()->getName(),
                'data-basetype' => $field->getDatatype()->getBasetype(),
                'title' => $field->getRenderable(static::LABEL, ''),
                'data-max-size' => $validators[File::MAX_SIZE] ?? '',
                'capture' => 'environment'
            ]
        );

        $accept = '';
        if ($validators[File::ACCEPT] ?? false) {
            if (is_array($validators[File::ACCEPT])) {
                $accept = join(',', $validators[File::ACCEPT]);
            } else {
                $accept = $validators[File::ACCEPT];
            }
            $input->setAttribute('accept', htmlspecialchars($accept));
        }
        if ($validators[Datatype::REQUIRED] ?? false) {
            $input->setAttribute('required', 'required');
        }
        if ($validators[File::MAX_SIZE] ?? false) {
            $input->setAttribute('data-max-size', $validators[File::MAX_SIZE]);
        }
        foreach ([static::DISABLED, static::READONLY] as $v) {
            if ($field->getRenderable($v, false)) {
                $input->setAttribute($v, $v);
            }
        }

        $content = HTMLElement::factory(
            'div',
            ['class' => 'formularium-file-origin-upload'],
            [
                $input,
                HTMLElement::factory(
                    'canvas',
                    [
                        'class' => 'formularium-file-preview',
                        'style' => "display: none; clear: both;"
                    ]
                ),
                HTMLElement::factory(
                    'input',
                    ['class' => 'formularium-button formularium-file-reset', 'type' => 'button', 'style' => "display: none;", 'value' => 'Clear file']
                )
            ]
        );
        if (array_key_exists(Renderable::LABEL, $renderable)) {
            $content->prependContent(new HTMLElement('label', ['for' => $input->getAttribute('id'), 'class' => 'formularium-label'], $renderable[Renderable::LABEL]));
        }
        if (array_key_exists(Renderable::COMMENT, $renderable)) {
            $content->appendContent(new HTMLElement('div', ['class' => 'formularium-comment'], $renderable[Renderable::COMMENT]));
        }

        /*
        <div class="loh_form_item loh_origin_upload">
            <span class="loh_fieldlabel"><?php echo _('File');?></span>
            <div class="loh_hide_picked">
                <span class="loh_explanation">
                    <?php echo _('Click the button to pick. You can also drag and drop a file into the grey area.');?>
                </span>
                <label class="loh_upload_file_label" for="loh:filedata_medium[<?php echo $id; ?>][value]">
                    <?php echo _('Click to pick a file or drag one here.');?>
                    <input type="file" class="loh_upload_file_button"
                        id="loh:filedata_medium[<?php echo $id; ?>][value]"
                        name="loh:filedata_medium[<?php echo $id; ?>][value]"
                        size="30" <?php echo ($acceptTag ? 'accept="' . htmlspecialchars($acceptTag) . '"' : '');?>
                        data-maxfilesize="<?php echo CONF('MAX_FILE_SIZE');?>"
                        capture="camera"/>
                </label>
            </div>
            <canvas class="loh_upload_preview" width="320" height="240"
                style="display: none; clear: both;"></canvas>
            <div class="loh_upload_filename clearfix"></div>
            <input type="button" class="loh_filedata_medium_reset" style="display: none;" value="<?php echo _('Clear file');?>"/>
        </div>
        */

        $container = new HTMLElement(Framework::getEditableContainerTag(), [], $content);

        return $container;
    }
}

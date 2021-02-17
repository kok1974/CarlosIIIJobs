<table>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="empresa">Empresa</label>
        </th>
        <td>
            <input type="text" id="empresa" name="empresa" value="<?php echo @get_post_meta($post->ID, 'empresa', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="titulacion">Titulaci&oacute;n</label>
        </th>
        <td>
            <input type="text" id="titulacion" name="titulacion" value="<?php echo @get_post_meta($post->ID, 'titulacion', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="fct">F.C.T.</label>
        </th>
        <td>
            <input type="text" id="fct" name="fct" value="<?php echo @get_post_meta($post->ID, 'fct', true); ?>" />
        </td>
    </tr>
</table>
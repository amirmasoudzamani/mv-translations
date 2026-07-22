<?php 

global $wpdb;
$query =  $wpdb->prepare(
    "SELECT * FROM $wpdb->translationmeta
        WHERE translation_id = %d",
    $post->ID
);

$results = $wpdb->get_results($query, ARRAY_A);
?>
<div style="display: flex; flex-direction: column;">
    <input type="hidden" name="mv_translations_nonce" value="<?= wp_create_nonce('mv_translations_nonce'); ?>">
    <input type="hidden" name="mv_translations_action" value="<?= (empty($results[0]['meta_value']) || empty($results[1]['meta_value']) ? 'save' : 'update'); ?>">
    
    <label for="mv_translations_transliteration"><?php esc_html_e('Has transliteration?', 'mv-translations'); ?></label>
    <select name="mv_translations_transliteration" id="mv_translations_transliteration">
        <option value="Yes" <?php if(isset($results[0]['meta_value'])) selected($results[0]['meta_value'], 'Yes'); ?>><?php esc_html_e('Yes', 'mv-translations') ?></option>
        <option value="No" <?php if(isset($results[0]['meta_value'])) selected($results[0]['meta_value'], 'No'); ?>><?php esc_html_e('No', 'mv-translations') ?></option>
    </select>

    <label for="mv_translations_video_url"><?php esc_html_e('Video URL', 'mv-translations'); ?></label>
    <input type="url" name="mv_translations_video_url" id="mv_translations_video_url" value="<?= (isset($results[1]['meta_value'])) ? esc_url($results[1]['meta_value']) : ""; ?>">
</div>
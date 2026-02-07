<?php

    if (@$seoContents && gettype(@$seoContents) == 'array') {
        $seoContents = json_decode(json_encode($seoContents, true));
    }

    if (@$seoContents->image_size) {
        $socialImageSize = explode('x', $seoContents->image_size);
    } else {
        @$socialImageSize = explode('x', getFileSize('seo'));
    }
?>

<?php if($seo): ?>
    <meta name="title" Content="<?php echo e(gs()->siteName(__($pageTitle))); ?>">
    <meta name="description" content="<?php echo e(@$seoContents->description ?? $seo->description); ?>">
    <meta name="keywords" content="<?php echo e(implode(',', @$seoContents->keywords ?? $seo->keywords)); ?>">
    <link type="image/x-icon" href="<?php echo e(siteFavicon()); ?>" rel="shortcut icon">

    
    <link href="<?php echo e(siteLogo()); ?>" rel="apple-touch-icon">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php echo e(gs()->siteName($pageTitle)); ?>">
    
    <meta itemprop="name" content="<?php echo e(gs()->siteName($pageTitle)); ?>">
    <meta itemprop="description" content="<?php echo e(@$seoContents->description ?? $seo->description); ?>">
    <meta itemprop="image" content="<?php echo e($seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image)); ?>">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(@$seoContents->social_title ?? $seo->social_title); ?>">
    <meta property="og:description" content="<?php echo e(@$seoContents->social_description ?? $seo->social_description); ?>">
    <meta property="og:image" content="<?php echo e($seoImage ?? getImage(getFilePath('seo') . '/' . $seo->image)); ?>">
    <meta property="og:image:type" content="image/<?php echo e(pathinfo(getImage(getFilePath('seo')) . '/' . $seo->image)['extension']); ?>">

    <meta property="og:image:width" content="<?php echo e($socialImageSize[0]); ?>">
    <meta property="og:image:height" content="<?php echo e($socialImageSize[1]); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
<?php endif; ?>
<?php /**PATH /home/paheliherbals/public_html/core/resources/views/partials/seo.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Gallery</title>
<style>
    .images-container {
        display: none;
    }

    .show {
        display: block;
    }

    .visible img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
    }

    .image-item {
        display: inline-block;
        margin: 10px;
        cursor: pointer;
    }

    .image-name {
        text-align: center;
    }

    .event {
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<?php
function getEventFolders($directory) {
    $folders = array_filter(glob($directory . '/*'), 'is_dir');
    return $folders;
}

function getImageFiles($directory) {
    $files = array_filter(glob($directory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE), 'is_file');
    return $files;
}

$eventFolders = getEventFolders('events');

foreach ($eventFolders as $eventFolder) {
    $eventName = basename($eventFolder);
    $imageFiles = getImageFiles($eventFolder);

    echo "<div class='event'>";
    echo "<h2 class='event-title'>$eventName</h2>";
    if (!empty($imageFiles)) {
        echo "<div class='images-container'>";
        foreach ($imageFiles as $image) {
            echo "<div class='image-item'>";
            echo "<img src='eyecheck.png' data-src='$image' alt='" . basename($image) . "' />";
            echo "<p class='image-name'>" . basename($image) . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No images found for this event.</p>";
    }
    echo "</div>";
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var eventTitles = document.querySelectorAll('.event-title');

    eventTitles.forEach(function(title) {
        title.addEventListener('click', function() {
            var imagesContainer = this.nextElementSibling;
            imagesContainer.classList.toggle('show');
        });
    });

    var imageItems = document.querySelectorAll('.image-item');

    imageItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var image = this.querySelector('img');
            var src = image.getAttribute('data-src');
            image.setAttribute('src', src);
            this.classList.add('visible');
        });
    });
});
</script>

</body>
</html>

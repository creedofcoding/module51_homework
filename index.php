<?php

// Загружаем HTML файл
$html = file_get_contents('task.html');

// Создаем новый DOM объект
$dom = new DOMDocument;

// Загружаем HTML в DOM
libxml_use_internal_errors(true);  // Для игнорирования предупреждений из-за ошибок в HTML
$dom->loadHTML($html);
libxml_clear_errors();

// Извлекаем <title>
$title = $dom->getElementsByTagName('title')->item(0);
if ($title) {
    echo 'Title: ' . $title->textContent . "<br/><br/>";
} else {
    echo 'Title: Нет тега title' . "<br/><br/>";
}

// Извлекаем мета тег description
$description = null;
$metas = $dom->getElementsByTagName('meta');
foreach ($metas as $metaTag) {
    if ($metaTag instanceof DOMElement) {
        $name = $metaTag->getAttribute('name');
        if ($name === 'description') {
            $description = $metaTag->getAttribute('content');
            break;
        }
    }
}
if ($description) {
    echo 'Description: ' . $description . "<br/><br/>";
} else {
    echo 'Description: Нет описания' . "<br/><br/>";
}

// Извлекаем мета тег keywords
$keywords = null;
foreach ($metas as $metaTag) {
    if ($metaTag instanceof DOMElement) {
        $name = $metaTag->getAttribute('name');
        if ($name === 'keywords') {
            $keywords = $metaTag->getAttribute('content');
            break;
        }
    }
}
if ($keywords) {
    echo 'Keywords: ' . $keywords . "<br/><br/>";
} else {
    echo 'Keywords: Нет ключевых слов' . "<br/><br/>";
}
?>

<?php
// Simulate glossary autolink matching from base.twig
$raw = require __DIR__ . '/../content/glossary_data.php';
$glossaryMap = [];
foreach ($raw as $key => $item) {
    $anchor = preg_replace('/[^a-z0-9]+/', '-', strtolower(trim((string)$key)));
    $anchor = trim($anchor, '-');
    $term = strtolower(trim((string)($item['term'] ?? $key)));
    if ($term !== '') $glossaryMap[$term] = $anchor;
    $compactTerm = preg_replace('/[^a-z0-9]+/i', '', $term);
    if ($compactTerm !== '' && $compactTerm !== $term) $glossaryMap[$compactTerm] = $anchor;
    if (isset($item['aliases']) && is_array($item['aliases'])) {
        foreach ($item['aliases'] as $alias) {
            $a = strtolower(trim((string)$alias));
            if ($a !== '') $glossaryMap[$a] = $anchor;
            $compactA = preg_replace('/[^a-z0-9]+/i', '', $a);
            if ($compactA !== '' && $compactA !== $a) $glossaryMap[$compactA] = $anchor;
        }
    }
    if (isset($item['sub_terms']) && is_array($item['sub_terms'])) {
        foreach (array_keys($item['sub_terms']) as $sub) {
            $s = strtolower(trim((string)$sub));
            if ($s !== '') $glossaryMap[$s] = $anchor;
            $compactS = preg_replace('/[^a-z0-9]+/i', '', $s);
            if ($compactS !== '' && $compactS !== $s) $glossaryMap[$compactS] = $anchor;
        }
    }
}

// Terms sorted by length desc
$terms = array_keys($glossaryMap);
usort($terms, function($a,$b){ return strlen($b) <=> strlen($a); });

function isWordChar($ch) {
    return $ch !== '' && preg_match('/[A-Za-z0-9_]/u', $ch) === 1;
}
function isUpper($ch) {
    return $ch !== '' && preg_match('/[A-ZÁÉÍÓÚÜÑ]/u', $ch) === 1;
}
function isLower($ch) {
    return $ch !== '' && preg_match('/[a-záéíóúüñ]/u', $ch) === 1;
}
function isValidTermBoundary($text, $start, $length) {
    $before = $start > 0 ? $text[$start - 1] : '';
    $after = $start + $length < strlen($text) ? $text[$start + $length] : '';
    $beforeWord = isWordChar($before);
    $afterWord = isWordChar($after);

    if (!$beforeWord && !$afterWord) return true;
    if (!$beforeWord && $after !== '' && isUpper($after)) return true;
    if ($before !== '' && isLower($before) && $after !== '' && isUpper($after)) return true;
    if ($before !== '' && isLower($before) && !$afterWord && $after === '') return true;
    return false;
}

function findMatches($text, $terms, $glossaryMap) {
    $lower = mb_strtolower($text, 'UTF-8');
    $len = mb_strlen($text, 'UTF-8');
    $cursor = 0;
    $out = [];

    while ($cursor < $len) {
        $nextMatch = null;
        $nextTerm = null;
        foreach ($terms as $term) {
            $index = mb_stripos($lower, $term, $cursor, 'UTF-8');
            if ($index === false) continue;
            if ($nextMatch === null || $index < $nextMatch || ($index === $nextMatch && mb_strlen($term,'UTF-8') > mb_strlen($nextTerm,'UTF-8'))) {
                $nextMatch = $index;
                $nextTerm = $term;
            }
        }
        if ($nextMatch === null) break;
        // Convert multi-byte positions to byte offsets for substring
        $before = mb_substr($text, 0, $nextMatch, 'UTF-8');
        $termStart = mb_strlen($before, 'UTF-8');
        $termLength = mb_strlen($nextTerm, 'UTF-8');

        if (isValidTermBoundary($text, $termStart, $termLength)) {
            $matchedText = mb_substr($text, $termStart, $termLength, 'UTF-8');
            $out[] = ['term'=>$nextTerm, 'text'=>$matchedText, 'anchor'=>$glossaryMap[$nextTerm], 'pos'=>$termStart];
            $cursor = $termStart + $termLength;
        } else {
            $cursor = $termStart + 1;
        }
    }

    return $out;
}

$samples = [
    'dashboardUI',
    'hashSHA-256',
    'StorageFacade',
    'procesamientoStreaming',
    'thisContainsCrudInside',
];

foreach ($samples as $s) {
    $matches = findMatches($s, $terms, $glossaryMap);
    echo "Input: {$s}\n";
    if (empty($matches)) {
        echo "  No matches\n\n";
        continue;
    }
    foreach ($matches as $m) {
        echo "  Matched '{$m['text']}' (term key: {$m['term']}, anchor: {$m['anchor']}, pos: {$m['pos']})\n";
    }
    echo "\n";
}


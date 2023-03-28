<?php
function getWeeksArray($startDate, $endDate)
{
    $weeks = [];
    $currentWeek = [];
    $currentDate = new DateTime($startDate);
    while ($currentDate <= new DateTime($endDate)) {
        // $currentWeek[] = $currentDate->format('Y-m-d');
        $currentDate->add(new DateInterval('P1D'));
        if (
            $currentDate->format('w') === '0' ||
            $currentDate > new DateTime($endDate)
        ) {
            $weeks[] = $currentWeek;
            $currentWeek = [];
        }
    }
    return $weeks;
}

$weeksArray = getWeeksArray('2023-03-28', '2023-12-28');
echo "<div class='weeks'>";
echo "<div class='container'>";
echo "<div class='row'>";
foreach ($weeksArray as $index => $week) {
    $currentWeekClass = $index === 0 ? ' box' : '';
    echo "<div class='week col-sm-12 col-md-2" . $currentWeekClass . "'>";
    echo '<h4>Semaine ' . ($index + 1) . '</h4>';
    echo '<ul>';
    foreach ($week as $day) {
        echo '<li>' . $day . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';
?>
<?php
include 'menu.php';

function getMonthsArray($startDate, $endDate)
{
    $months = [];
    $currentMonth = [];
    $currentDate = new DateTime($startDate);
    while ($currentDate <= new DateTime($endDate)) {
        $currentMonth[] = $currentDate->format('Y-m-d');
        $currentDate->add(new DateInterval('P1D'));
        if (
            $currentDate->format('d') === '01' ||
            $currentDate > new DateTime($endDate)
        ) {
            $months[] = $currentMonth;
            $currentMonth = [];
        }
    }
    return $months;
}

$today = new DateTime();
$conceptionDateee = '01-01-2023';

$date = strtotime($conceptionDatee);
$newDate = strtotime('+ 285 days', $date);

$monthsArray = getMonthsArray($conceptionDateee, '2023-09-28');
?>

<div class='months'>
    <div class='container table p-3'>
        <div class='tr row'>
            <?php foreach ($monthsArray as $index => $month):

                $currentMonthClass = '';
                $firstDayOfCurrentMonth = new DateTime($month[0]);
                $lastDayOfCurrentMonth = new DateTime(end($month));
                if (
                    $today >= $firstDayOfCurrentMonth &&
                    $today <= $lastDayOfCurrentMonth
                ) {
                    $currentMonthClass = ' current-month';
                }
                ?>
            <div class='td month col-4 mx-auto<?= $currentMonthClass ?>'>
                <p class='text text-center'><?= $firstDayOfCurrentMonth->format(
                    'F Y'
                ) ?></p>
            </div>
            <?php
            endforeach; ?>
        </div>
    </div>
</div>

<style>
table {
    border: 1px solid black;
}

.months {
    background-color: #fce4d6;
    width: 80%;
    margin: auto;
    padding-top: 10px;
    border-radius: 5px;
}

.month {
    border: 1px solid black;
    padding-top: 7px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.current-month {
    border: 10px solid #fa899c;
}

.text {
    width: 100%;
}
</style>
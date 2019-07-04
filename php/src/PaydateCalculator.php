<?php

declare(strict_types=1);

final class PaydateCalculator
{
    /**
     * An array of available pay spans
     *
     * @var array
     */
    protected $_paySpans = array(
        'weekly' => '+1 week',
        'bi-weekly' => '+2 week',
        'monthly' => '+1 month',
    );
    /**
     * This function determines the first available due date following the funding of a loan.
     * 
     * The paydate will be at least 10 days in the future from the $fundDate. The
     * due_date will fall on a day that is a paydate based on their paydate model
     * specified by '$paySpan' unless the date must be adjusted forward to miss a
     * weekend or backward to miss a holiday
     * Holiday adjustment takes precedence over Weekend.
     * 
     * @param unix_timestamp $fundDate The day the loan was funded.
     * @param array $holidayArray An array of unix timestamp's containing holidays.
     * @param string $paySpan A string representing the frequency at which the customer is paid. (weekly,bi-weekly,monthly)
     * @param unix_timestamp $payDate A timestamp containing one of the customers paydays
     * @param bool $directDeposit A boolean determining whether or not the customer receives their paycheck via direct deposit.
     * 
     * @return unix_timestamp A unix timestamp representing the determined due date.
     */
    public function calculateDueDate(int $fundDate, array $holidayArray, string $paySpan, int $payDate, bool $directDeposit) : int
    {
        // If loop type is true, then forward, else reverse
        $loopType = true;
        // Get next pay date based on pay span
        $dueDate = strtotime($this->_paySpans[$paySpan], $payDate);
        // If not direct deposit, increment due date by 1 day
        if (empty($directDeposit)) {
            $dueDate = strtotime('+1 day', $dueDate);
        }
        // Check until due date is not on a holiday or weekend
        do {
            // Check if due date is on a holiday
            $isHoliday = in_array($dueDate, $holidayArray, true);
            // Check if due date is on a weekend
            $isWeekend = date('w', $dueDate) % 6 == 0;
            // Check if due date is on a holiday or weekend
            if ($isHoliday || $isWeekend) {
                // If due date is on a holiday, set loop type to reverse, else keep current loop type
                $loopType = $isHoliday ? false : $loopType;
                // If loop type is forward, increment due date by 1 day, else decrement due date by 1 day
                $dueDate = strtotime(($loopType ? '+1 day' : '-1 day'), $dueDate);
            }
        } while ($isHoliday || $isWeekend);
        // Check if the due date is gte 10 days from the fund date
        if ($dueDate >= strtotime('+10 days', $fundDate)) {
            // Return due date
            return $dueDate;
        } else {
            // Continue to next pay date
            return $this->calculateDueDate($fundDate, $holidayArray, $paySpan, strtotime($this->_paySpans[$paySpan], $payDate), $directDeposit);
        }
    }
}

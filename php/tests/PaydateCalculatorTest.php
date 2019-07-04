<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PaydateCalculatorTest extends TestCase
{
    public function testGetNextDueDateWithWeeklyPayAndWithNoDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithWeeklyPayAndWithDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithWeeklyPayAndWithNoDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+1 week', $payDate));
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithWeeklyPayAndWithDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+1 week', $payDate));
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithBiWeeklyPayAndWithNoDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'bi-weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithBiWeeklyPayAndWithDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'bi-weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithBiWeeklyPayAndWithNoDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'bi-weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+2 week', $payDate));
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithBiWeeklyPayAndWithDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'bi-weekly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+2 week', $payDate));
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithMonthlyPayAndWithNoDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'monthly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithMonthlyPayAndWithDirectDepositAndWithNoHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'monthly';
        $payDate = strtotime('+1 day');
        $holidayArray = array();
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithMonthlyPayAndWithNoDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'monthly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+1 month', $payDate));
        $directDeposit = false;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
    public function testGetNextDueDateWithMonthlyPayAndWithDirectDepositAndWithHolidays(): void
    {
        $paydate = new PaydateCalculator();
        $fundDate = strtotime('now');
        $paySpan = 'monthly';
        $payDate = strtotime('+1 day');
        $holidayArray = array(strtotime('+1 month', $payDate));
        $directDeposit = true;
        $dueDate = $paydate->calculateDueDate($fundDate, $holidayArray, $paySpan, $payDate, $directDeposit);
        $this->assertGreaterThanOrEqual(strtotime('+10 days', $fundDate), $dueDate);
        $this->assertFalse(in_array($dueDate, $holidayArray, true));
        $this->assertFalse(date('w', $dueDate)  % 6 == 0);
    }
}

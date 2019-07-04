import * as moment from 'moment';

export default class PaydateCalculator {
    protected paySpan = {
        'bi-weekly': { week: 2 },
        monthly: { month: 1 },
        weekly: { week: 1 },
    };
    /**
     * This function determines the first available due date following the funding of a loan.
     * 
     * The paydate will be at least 10 days in the future from the fundDate. The
     * due_date will fall on a day that is a paydate based on their paydate model
     * specified by 'paySpan' unless the date must be adjusted forward to miss a
     * weekend or backward to miss a holiday
     * Holiday adjustment takes precedence over Weekend.
     * 
     * @param unix_timestamp fundDate The day the loan was funded.
     * @param array holidayArray An array of unix timestamp's containing holidays.
     * @param string paySpan A string representing the frequency at which the customer is paid. (weekly,bi-weekly,monthly)
     * @param unix_timestamp payDate A timestamp containing one of the customers paydays
     * @param boolean directDeposit A boolean determining whether or not the customer receives their paycheck via direct deposit.
     * 
     * @return unix_timestamp A unix timestamp representing the determined due date.
     */
    public calculateDueDate(fundDate: number, holidayArray: number[], paySpan: 'weekly' | 'bi-weekly' | 'monthly', payDate: number, directDeposit: boolean): number {
        // If loop type is true, then forward, else reverse
        let loopType = true;
        // Get next pay date based on pay span
        let dueDate = moment.unix(payDate).startOf('day').add(this.paySpan[paySpan]).unix();
        // If not direct deposit, increment due date by 1 day
        if (!directDeposit) {
            dueDate = moment.unix(dueDate).add({ day: 1 }).unix();
        }
        let isHoliday = false;
        let isWeekend = false;
        // Check until due date is not on a holiday or weekend
        do {
            // Check if due date is on a holiday
            isHoliday = holidayArray.findIndex((holiday) => dueDate === holiday) > -1;
            // Check if due date is on a weekend
            isWeekend = moment.unix(dueDate).day() % 6 === 0;
            // Check if due date is on a holiday or weekend
            if (isHoliday || isWeekend) {
                // If due date is on a holiday, set loop type to reverse, else keep current loop type
                loopType = isHoliday ? false : loopType;
                // If loop type is forward, increment due date by 1 day, else decrement due date by 1 day
                dueDate = moment.unix(dueDate).add({ day: 1 * (loopType ? 1 : -1) }).unix();
            }
        } while (isHoliday || isWeekend);
        // Check if the due date is gte 10 days from the fund date
        if (dueDate >= moment.unix(fundDate).startOf('day').add({ day: 10 }).unix()) {
            // Return due date
            return dueDate;
        } else {
            // Continue to next pay date
            return this.calculateDueDate(fundDate, holidayArray, paySpan, moment.unix(payDate).startOf('day').add(this.paySpan[paySpan]).unix(), directDeposit);
        }
    }
}

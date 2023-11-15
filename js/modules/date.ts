class farallonDate {
    selector: string;
    timeFormat: any = {
        second: 'second ago',
        seconds: 'seconds ago',
        minute: 'minute ago',
        minutes: 'minutes ago',
        hour: 'hour ago',
        hours: 'hours ago',
        day: 'day ago',
        days: 'days ago',
        week: 'week ago',
        weeks: 'weeks ago',
        month: 'month ago',
        months: 'months ago',
        year: 'year ago',
        years: 'years ago',
    };
    doms: Array<any> = [];
    constructor(config: any) {
        this.selector = config.selector;
        if (config.timeFormat) {
            this.timeFormat = config.timeFormat;
        }
        this.init();
        setTimeout(() => {
            this.refresh();
        }, 1000 * 5);
    }

    init() {
        this.doms = Array.from(document.querySelectorAll(this.selector));
        this.doms.forEach((dom: any) => {
            dom.innerText = this.humanize_time_ago(dom.attributes['datetime'].value);
        });
    }

    humanize_time_ago(datetime: string) {
        const time = new Date(datetime);
        const between: number = Date.now() / 1000 - Number(time.getTime() / 1000);
        if (between < 3600) {
            return `${Math.ceil(between / 60)} ${
                Math.ceil(between / 60) == 1 ? this.timeFormat.second : this.timeFormat.seconds
            }`;
        } else if (between < 86400) {
            return `${Math.ceil(between / 3600)} ${
                Math.ceil(between / 3660) == 1 ? this.timeFormat.hour : this.timeFormat.hours
            }`;
        } else if (between < 86400 * 30) {
            return `${Math.ceil(between / 86400)} ${
                Math.ceil(between / 86400) == 1 ? this.timeFormat.day : this.timeFormat.days
            }`;
        } else if (between < 86400 * 30 * 12) {
            return `${Math.ceil(between / (86400 * 30))} ${
                Math.ceil(between / (86400 * 30)) == 1
                    ? this.timeFormat.month
                    : this.timeFormat.months
            }`;
        } else {
            return time.getFullYear() + '-' + (time.getMonth() + 1) + '-' + time.getDate();
        }
    }

    refresh() {
        this.doms.forEach((dom: any) => {
            dom.innerText = this.humanize_time_ago(dom.attributes['datetime'].value);
        });
    }
}

new farallonDate({
    selector: '.humane--time',
    //@ts-ignore
    timeFormat: obvInit.timeFormat,
});
